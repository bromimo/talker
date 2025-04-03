<?php

namespace core\Talker\Traits;

use core\Talker\Dto\RouteDto;
use core\Talker\Enums\RouteMethodEnum;

trait HasPreg
{
    public static function preg(string $name, array|string|null $action = null): void
    {
        self::addRoute(RouteMethodEnum::Preg, $name, $action);
    }

    private static function parsePreg(array $routes, string $text): void
    {
        /** @var RouteDto $route */
        foreach ($routes as $route) {
            if ($route->method === RouteMethodEnum::Preg && preg_match($route->name, $text, $matches)) {
                if (is_string($route->action)) {
                    self::runController($route->action, $matches);

                    exit();
                }
                if (is_array($route->action)) {
                    if (self::isControllerAction($route)) {
                        self::runController($route->action[0], $matches, $route->action[1]);

                        exit();
                    }
                }
            }
        }
    }
}