<?php

namespace core\Telegram\Dto;

use core\Telegram\Dto\MaybeInaccessibleMessage\MessageDto;
use Spatie\DataTransferObject\DataTransferObject;

final class UpdateDto extends DataTransferObject
{
    public int                             $update_id;
    public ?MessageDto                     $message;
    public ?MessageDto                     $edited_message;
    public ?MessageDto                     $channel_post;
    public ?MessageDto                     $edited_channel_post;
    public ?BusinessConnectionDto          $business_connection;
    public ?MessageDto                     $business_message;
    public ?MessageDto                     $edited_business_message;
    public ?BusinessMessagesDeletedDto     $deleted_business_messages;
    public ?MessageReactionUpdatedDto      $message_reaction;
    public ?MessageReactionCountUpdatedDto $message_reaction_count;
    public ?InlineQueryDto                 $inline_query;
    public ?ChosenInlineResultDto          $chosen_inline_result;
    public ?CallbackQueryDto               $callback_query;
    public ?ShippingQueryDto               $shipping_query;
    public ?PreCheckoutQueryDto            $pre_checkout_query;
    public ?PaidMediaPurchasedDto          $purchased_paid_media;
    public ?PollDto                        $poll;
    public ?PollAnswerDto                  $poll_answer;
    public ?ChatMemberUpdatedDto           $my_chat_member;
    public ?ChatMemberUpdatedDto           $chat_member;
    public ?ChatJoinRequestDto             $chat_join_request;
    public ?ChatBoostUpdatedDto            $chat_boost;
    public ?ChatBoostRemovedDto            $removed_chat_boost;

    public function isMessage(): bool
    {
        return $this->message !== null;
    }
}