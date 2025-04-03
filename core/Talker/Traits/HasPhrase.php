<?php

namespace core\Talker\Traits;

use Exception;
use core\Talker\Dto\RouteDto;
use core\Telegram\Dto\UpdateDto;
use core\Talker\Enums\RouteMethodEnum;

trait HasPhrase
{
    public static function phrase(string $name, array|string|callable|null $action = null): self
    {
        self::addRoute(RouteMethodEnum::Phrase, $name, $action);

        return self::getInstance();
    }

    public function alias(array $alias): void
    {
        if (!empty(self::$stack)) {
            $parentIndex = array_key_last(self::$stack);
            if (isset(self::$stack[$parentIndex]['action'])) {
                $subIndex = array_key_last(self::$stack[$parentIndex]['action']);
                self::$stack[$parentIndex]['action'][$subIndex]->alias = $alias;
            }
        } else {
            $lastIndex = array_key_last(self::$routes);
            if ($lastIndex !== null) {
                self::$routes[$lastIndex]->alias = $alias;
            }
        }
    }

    private static function parsePhrase(array $routes, string $text): void
    {
        /** @var RouteDto $route */
        foreach ($routes as $route) {
            if ($route->method === RouteMethodEnum::Phrase && self::phraseContains($route, mb_strtolower($text))) {
                if (is_string($route->action)) {
                    self::runController($route->action);

                    exit();
                }
                if (is_array($route->action)) {
                    if (self::isControllerAction($route)) {
                        self::runController(controllerName: $route->action[0], methodName: $route->action[1]);

                        exit();
                    }
                    self::parsePhrase($route->action, $text);

                    exit();
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
}