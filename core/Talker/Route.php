<?php

namespace core\Talker;

use Closure;
use Exception;
use ReflectionClass;
use core\Talker\Dto\RouteDto;
use core\Abstracts\Singleton;
use core\Talker\Dto\CommandDto;
use core\Telegram\Dto\UpdateDto;
use core\Telegram\Components\Button;
use core\Talker\Enums\RouteMethodEnum;
use core\Telegram\Enums\MessageEntityTypeEnum;

class Route extends Singleton
{
    /** @var RouteDto[] */
    protected static array $routes = [];
    protected static array $stack  = [];

    public static function command(string $name, array|string|callable|null $action = null): void
    {
        self::addRoute(RouteMethodEnum::Command, $name, $action);
    }

    public static function phrase(string $name, array|string|callable|null $action = null): self
    {
        self::addRoute(RouteMethodEnum::Phrase, $name, $action);

        return self::getInstance();
    }

    public static function param(string $name, array|string|null $action = null): void
    {
        self::addRoute(RouteMethodEnum::Param, $name, $action);
    }

    public static function action(string $name, array|string|null $action = null): void
    {
        self::addRoute(RouteMethodEnum::Action, $name, $action);
    }

    public function alias(array $alias): void
    {
        if (empty(self::$stack)) {
            throw new Exception('Алиас можно задать только внутри маршрута.');
        }

        $parentIndex = array_key_last(self::$stack);
        if (isset(self::$stack[$parentIndex]['action'])) {
            $subIndex = array_key_last(self::$stack[$parentIndex]['action']);
            self::$stack[$parentIndex]['action'][$subIndex]->alias = $alias;
        }
    }

    private static function addRoute(RouteMethodEnum $method, string $name, array|string|callable|null $action = null): void
    {
        if ($action instanceof Closure) {
            $action = self::addSubRoute($action);
        }

        $route = new RouteDto(compact('method', 'name', 'action'));

        if (!empty(self::$stack)) {
            if ($method === RouteMethodEnum::Command) {
                throw new Exception('Метод command не может быть дочерним маршрутом.');
            }
            $parentIndex = array_key_last(self::$stack);
            self::$stack[$parentIndex]['action'][] = $route;
        } else {
            if ($method === RouteMethodEnum::Param) {
                throw new Exception('Метод param не может быть без command.');
            }
            self::$routes[] = $route;
        }
    }

    private static function addSubRoute(callable $action): array
    {
        self::$stack[] = ['action' => []];
        $action();
        $subRoutes = array_pop(self::$stack);

        return $subRoutes['action'];
    }

    public static function handle(UpdateDto $data)
    {
        if ($command = self::getCommand($data)) {
            self::parseCommand(self::$routes, $command);
        }
        if ($callback = self::getCallbackData($data)) {
            self::parseCallbackData(self::$routes, $callback);
        }
        if ($text = self::getText($data)) {
            self::parsePhrase(self::$routes, $text);
        }
    }

    private static function parsePhrase(array $routes, string $text): void
    {
        /** @var RouteDto $route */
        foreach ($routes as $route) {
            if ($route->method === RouteMethodEnum::Phrase && self::phraseContains($route, $text)) {
                if (is_string($route->action)) {
                    self::runController($route->action);

                    return;
                }
                if (is_array($route->action)) {
                    if (self::isControllerAction($route)) {
                        self::runController(controllerName: $route->action[0], methodName: $route->action[1]);

                        return;
                    }
                    self::parsePhrase($route->action, $text);

                    return;
                }
            }
        }
    }

    private static function phraseContains(RouteDto $route, string $text): bool
    {
        if (str_contains($text, $route->name)) {
            return true;
        }
        if ($route->alias) {
            foreach ($route->alias as $alias) {
                if (str_contains($text, $alias)) {
                    return true;
                }
            }
        }

        return false;
    }

    private static function parseCallbackData(array $routes, string $data): void
    {
        $pairs = explode(';', $data);
        $params = array_reduce($pairs, function ($carry, $item) {
            [$key, $value] = explode(':', $item, 2);
            $carry[$key] = $value;

            return $carry;
        }, []);
        if (!array_key_exists(Button::ACTION, $params)) {
            return;
        }
        foreach ($routes as $route) {
            if ($route->method === RouteMethodEnum::Action && $route->name === $params[Button::ACTION]) {
                if (is_string($route->action)) {
                    self::runController($route->action, $params);

                    return;
                }
                if (is_array($route->action)) {
                    if (self::isControllerAction($route)) {
                        self::runController($route->action[0], $params, $route->action[1]);

                        return;
                    }
                }
            }
        }
    }

    private static function parseCommand(array $routes, CommandDto $command): void
    {
        foreach ($routes as $route) {
            if ($route->method === RouteMethodEnum::Command && $command->name === $route->name) {
                if (is_string($route->action)) {
                    self::runController($route->action, $command->param);

                    return;
                }
                if (is_array($route->action)) {
                    if (self::isControllerAction($route)) {
                        self::runController($route->action[0], $command->param, $route->action[1]);

                        return;
                    }
                    self::parseParam($route->action, $command);

                    return;
                }
            }
        }
    }

    private static function parseParam(array $routes, CommandDto $command): void
    {
        foreach ($routes as $route) {
            if ($command->param === $route->name) {
                if (is_string($route->action)) {
                    self::runController($route->action, $command->param);

                    return;
                }
                if (is_array($route->action)) {
                    if (self::isControllerAction($route)) {
                        self::runController($route->action[0], $command->param, $route->action[1]);

                        return;
                    }
                }
            }
        }
    }

    private static function isControllerAction(RouteDto $route): bool
    {
        return count($route->action) === 2 && is_string($route->action[0]);
    }

    private static function getText(UpdateDto $data): ?string
    {
        return $data->message->text ?? null;
    }

    private static function getCallbackData(UpdateDto $data): ?string
    {
        return $data->callback_query->data ?? null;
    }

    private static function getCommand(UpdateDto $data): CommandDto|false
    {
        if (!$data->isMessage() || !$data->message->entities) {
            return false;
        }
        foreach ($data->message->entities as $entity) {
            if ($entity->type === MessageEntityTypeEnum::BotCommand) {
                $name = mb_substr($data->message->text, $entity->offset + 1, $entity->length - 1);
                $param = trim(mb_substr($data->message->text, 0, $entity->offset)
                    . mb_substr($data->message->text, $entity->offset + $entity->length));

                return new CommandDto(compact('name', 'param'));
            }
        }

        return false;
    }

    private static function runController(string $controllerName, string|array|null $param = null, string $methodName = '__invoke')
    {
        if (!str_contains($controllerName, '\\')) {
            $controllerName = 'core\\Talker\\Controllers\\' . $controllerName;
        }
        $class = new ReflectionClass($controllerName);
        $controller = $class->newInstance();
        if (!method_exists($controller, $methodName)) {
            throw new Exception("Method $methodName does not exist");
        }

        return $controller->$methodName($param);
    }
}