<?php

namespace core\Talker\Traits;

use core\Talker\Dto\CommandDto;
use core\Telegram\Dto\UpdateDto;
use core\Talker\Enums\RouteMethodEnum;
use core\Telegram\Enums\MessageEntityTypeEnum;

trait HasCommand
{
    public static function command(string $name, array|string|callable|null $action = null): void
    {
        self::addRoute(RouteMethodEnum::Command, $name, $action);
    }

    public static function param(string $name, array|string|null $action = null): void
    {
        self::addRoute(RouteMethodEnum::Param, $name, $action);
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

    private static function parseCommand(array $routes, CommandDto $command): void
    {
        foreach ($routes as $route) {
            if ($route->method === RouteMethodEnum::Command && $command->name === $route->name) {
                if (is_string($route->action)) {
                    self::runController($route->action, $command->param);

                    exit();
                }
                if (is_array($route->action)) {
                    if (self::isControllerAction($route)) {
                        self::runController($route->action[0], $command->param, $route->action[1]);

                        exit();
                    }
                    self::parseParam($route->action, $command);

                    exit();
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
}