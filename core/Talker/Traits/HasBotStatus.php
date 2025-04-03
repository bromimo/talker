<?php

namespace core\Talker\Traits;

use core\Telegram\Dto\UpdateDto;
use core\Talker\Enums\RouteMethodEnum;
use core\Telegram\Enums\ChatMemberStatusEnum;

trait HasBotStatus
{
    public static function botStatus(ChatMemberStatusEnum $status, array|string|null $action = null): void
    {
        self::addRoute(RouteMethodEnum::BotStatus, $status->value, $action);
    }

    private static function getMyChatMember(UpdateDto $data): ?string
    {
        return $data->my_chat_member?->new_chat_member->status ?? null;
    }

    private static function parseMyChatMember(array $routes, string $status): void
    {
        foreach ($routes as $route) {
            if ($route->method === RouteMethodEnum::BotStatus && $route->name === $status) {
                if (is_string($route->action)) {
                    self::runController($route->action);

                    exit();
                }
                if (is_array($route->action)) {
                    if (self::isControllerAction($route)) {
                        self::runController(controllerName: $route->action[0], methodName: $route->action[1]);

                        exit();
                    }
                }
            }
        }
    }
}