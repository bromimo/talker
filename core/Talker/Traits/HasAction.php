<?php

namespace core\Talker\Traits;

use core\Telegram\Dto\UpdateDto;
use core\Telegram\Components\Button;
use core\Talker\Enums\RouteMethodEnum;

trait HasAction
{
    public static function action(string $name, array|string|null $action = null): void
    {
        self::addRoute(RouteMethodEnum::Action, $name, $action);
    }

    private static function getCallbackData(UpdateDto $data): ?string
    {
        return $data->callback_query->data ?? null;
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
            exit();
        }
        foreach ($routes as $route) {
            if ($route->method === RouteMethodEnum::Action && $route->name === $params[Button::ACTION]) {
                if (is_string($route->action)) {
                    self::runController($route->action, $params);

                    exit();
                }
                if (is_array($route->action)) {
                    if (self::isControllerAction($route)) {
                        self::runController($route->action[0], $params, $route->action[1]);

                        exit();
                    }
                }
            }
        }
    }
}