<?php

namespace core\Talker\Traits;

use core\Telegram\Dto\UserDto;
use core\Telegram\Dto\UpdateDto;
use core\Talker\Dto\MemberStatusDto;
use core\Talker\Enums\RouteMethodEnum;
use core\Telegram\Enums\ChatMemberStatusEnum;

trait HasMemberStatus
{
    public static function memberStatus(ChatMemberStatusEnum $status, array|string|null $action = null): void
    {
        self::addRoute(RouteMethodEnum::MemberStatus, $status->value, $action);
    }

    private static function getMemberStatus(UpdateDto $data): ?MemberStatusDto
    {
        if (!is_null($data->message?->new_chat_members)) {
            return new MemberStatusDto(
                [
                    'status'           => ChatMemberStatusEnum::Member->value,
                    'new_chat_members' => $data->message->new_chat_members
                ]
            );
        }

        if (!is_null($data->message?->left_chat_member)) {
            return new MemberStatusDto(
                [
                    'status'           => ChatMemberStatusEnum::Left->value,
                    'left_chat_member' => $data->message->left_chat_member
                ]
            );
        }

        return null;
    }

    private static function parseMemberStatus(array $routes, MemberStatusDto $memberStatusDto): void
    {
        foreach ($routes as $route) {
            if ($route->method === RouteMethodEnum::MemberStatus && $route->name === $memberStatusDto->status) {
                if (is_string($route->action)) {
                    self::runController($route->action, self::getMembers($memberStatusDto));

                    exit();
                }
                if (is_array($route->action)) {
                    if (self::isControllerAction($route)) {
                        self::runController($route->action[0], self::getMembers($memberStatusDto), $route->action[1]);

                        exit();
                    }
                }
            }
        }
    }

    private static function getMembers(MemberStatusDto $data): UserDto|array
    {
        return $data->new_chat_members ?? $data->left_chat_member;
    }
}