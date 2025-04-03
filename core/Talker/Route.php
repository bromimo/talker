<?php

namespace core\Talker;

use Closure;
use Exception;
use ReflectionClass;
use core\Talker\Dto\RouteDto;
use core\Abstracts\Singleton;
use core\Talker\Traits\HasPreg;
use core\Telegram\Dto\UpdateDto;
use core\Talker\Traits\HasAction;
use core\Talker\Traits\HasPhrase;
use core\Talker\Traits\HasCommand;
use core\Talker\Traits\HasBotStatus;
use core\Talker\Enums\RouteMethodEnum;
use core\Talker\Enums\MessageTypeEnum;
use core\Talker\Traits\HasMemberStatus;

class Route extends Singleton
{
    use HasAction, HasBotStatus, HasCommand, HasMemberStatus, HasPhrase, HasPreg;

    /** @var RouteDto[] */
    protected static array $routes = [];
    protected static array $stack  = [];

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
        if ($my_chat_member = self::getMyChatMember($data)) {
            self::parseMyChatMember(self::$routes, $my_chat_member);
            exit();
        }
        if ($member_status = self::getMemberStatus($data)) {
            self::parseMemberStatus(self::$routes, $member_status);
            exit();
        }
        if ($command = self::getCommand($data)) {
            self::parseCommand(self::$routes, $command);
            exit();
        }
        if ($callback = self::getCallbackData($data)) {
            self::parseCallbackData(self::$routes, $callback);
            exit();
        }
        if ($text = self::getText($data)) {
            self::parsePreg(self::$routes, $text);
            self::parsePhrase(self::$routes, $text);
            exit();
        }
        if (self::isMessage($data)) {
            self::runController(config('bot.default_controller'));
        }
    }

    private static function isMessage(UpdateDto $data): bool
    {
        foreach (MessageTypeEnum::cases() as $message_type) {
            if (!is_null($data->{$message_type->value})) {
                return true;
            }
        }

        return false;
    }

    private static function isControllerAction(RouteDto $route): bool
    {
        return count($route->action) === 2 && is_string($route->action[0]);
    }

    private static function runController(string $controllerName, mixed $param = null, string $methodName = '__invoke')
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

    private static function getText(UpdateDto $data): ?string
    {
        return $data->message->text ?? null;
    }
}