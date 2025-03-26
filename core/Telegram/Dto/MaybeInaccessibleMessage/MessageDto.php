<?php

namespace core\Telegram\Dto\MaybeInaccessibleMessage;

use core\Telegram\Dto\PollDto;
use core\Telegram\Dto\ChatDto;
use core\Telegram\Dto\UserDto;
use core\Telegram\Dto\GameDto;
use core\Telegram\Dto\DiceDto;
use core\Telegram\Dto\VoiceDto;
use core\Telegram\Dto\AudioDto;
use core\Telegram\Dto\VenueDto;
use core\Telegram\Dto\StoryDto;
use core\Telegram\Dto\VideoDto;
use core\Telegram\Dto\StickerDto;
use core\Telegram\Dto\ContactDto;
use core\Telegram\Dto\InvoiceDto;
use core\Telegram\Dto\GiveawayDto;
use core\Telegram\Dto\LocationDto;
use core\Telegram\Dto\DocumentDto;
use core\Telegram\Dto\PhotoSizeDto;
use core\Telegram\Dto\AnimationDto;
use core\Telegram\Dto\TextQuoteDto;
use core\Telegram\Dto\VideoNoteDto;
use core\Telegram\Dto\ChatSharedDto;
use core\Telegram\Dto\WebAppDataDto;
use core\Telegram\Dto\UsersSharedDto;
use core\Telegram\Dto\PassportDataDto;
use core\Telegram\Dto\PaidMediaInfoDto;
use core\Telegram\Dto\MessageEntityDto;
use core\Telegram\Dto\VideoChatEndedDto;
use core\Telegram\Dto\ChatBackgroundDto;
use core\Telegram\Dto\ChatBoostAddedDto;
use core\Telegram\Dto\RefundedPaymentDto;
use core\Telegram\Dto\GiveawayCreatedDto;
use core\Telegram\Dto\GiveawayWinnersDto;
use core\Telegram\Dto\ForumTopicClosedDto;
use core\Telegram\Dto\ForumTopicEditedDto;
use core\Telegram\Dto\VideoChatStartedDto;
use core\Telegram\Dto\ForumTopicCreatedDto;
use core\Telegram\Dto\SuccessfulPaymentDto;
use core\Telegram\Dto\ExternalReplyInfoDto;
use core\Telegram\Dto\GiveawayCompletedDto;
use core\Telegram\Dto\VideoChatScheduledDto;
use core\Telegram\Dto\ForumTopicReopenedDto;
use core\Telegram\Dto\WriteAccessAllowedDto;
use core\Telegram\Dto\LinkPreviewOptionsDto;
use core\Telegram\Dto\InlineKeyboardMarkupDto;
use core\Telegram\Dto\GeneralForumTopicHiddenDto;
use core\Telegram\Dto\ProximityAlertTriggeredDto;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Casters\ArrayCaster;
use core\Telegram\Dto\VideoChatParticipantsInvitedDto;
use core\Telegram\Dto\MessageAutoDeleteTimerChangedDto;
use core\Telegram\Dto\MessageOrigin\MessageOriginCaster;
use core\Telegram\Dto\MessageOrigin\MessageOriginInterface;

final class MessageDto extends DataTransferObject implements MaybeInaccessibleMessageInterface
{
    public int                     $message_id;
    public int                     $date;
    public ?int                    $message_thread_id;
    public ?UserDto                $from;
    public ?ChatDto                $sender_chat;
    public ?int                    $sender_boost_count;
    public ?UserDto                $sender_business_bot;
    public ?string                 $business_connection_id;
    public ?ChatDto                $chat;
    #[CastWith(MessageOriginCaster::class)]
    public ?MessageOriginInterface $forward_origin;
    public ?bool                   $is_topic_message;
    public ?bool                   $is_automatic_forward;
    public ?self                   $reply_to_message;
    public ?ExternalReplyInfoDto   $external_reply;
    public ?TextQuoteDto           $quote;
    public ?StoryDto               $reply_to_story;
    public ?UserDto                $via_bot;
    public ?int                    $edit_date;
    public ?bool                   $has_protected_content;
    public ?bool                   $is_from_offline;
    public ?string                 $media_group_id;
    public ?string                 $author_signature;
    public ?string                 $text;
    /** @var MessageEntityDto[]|null */
    #[CastWith(ArrayCaster::class, MessageEntityDto::class)]
    public ?array $entities;
    /** @var LinkPreviewOptionsDto[]|null */
    public ?array            $link_preview_options;
    public ?string           $effect_id;
    public ?AnimationDto     $animation;
    public ?AudioDto         $audio;
    public ?DocumentDto      $document;
    public ?PaidMediaInfoDto $paid_media;
    /** @var PhotoSizeDto[]|null */
    public ?array        $photo;
    public ?StickerDto   $sticker;
    public ?StoryDto     $story;
    public ?VideoDto     $video;
    public ?VideoNoteDto $video_note;
    public ?VoiceDto     $voice;
    public ?string       $caption;
    /** @var MessageEntityDto[]|null */
    public ?array       $caption_entities;
    public ?bool        $show_caption_above_media;
    public ?bool        $has_media_spoiler;
    public ?ContactDto  $contact;
    public ?DiceDto     $dice;
    public ?GameDto     $game;
    public ?PollDto     $poll;
    public ?VenueDto    $venue;
    public ?LocationDto $location;
    /** @var UserDto[]|null */
    public ?array   $new_chat_members;
    public ?UserDto $left_chat_member;
    public ?string  $new_chat_title;
    /** @var PhotoSizeDto[]|null */
    public ?array                             $new_chat_photo;
    public ?bool                              $delete_chat_photo;
    public ?bool                              $group_chat_created;
    public ?bool                              $supergroup_chat_created;
    public ?bool                              $channel_chat_created;
    public ?MessageAutoDeleteTimerChangedDto  $message_auto_delete_timer_changed;
    public ?int                               $migrate_to_chat_id;
    public ?int                               $migrate_from_chat_id;
    #[CastWith(MaybeInnaccessibleMessageCaster::class)]
    public ?MaybeInaccessibleMessageInterface $pinned_message;
    public ?InvoiceDto                        $invoice;
    public ?SuccessfulPaymentDto              $successful_payment;
    public ?RefundedPaymentDto                $refunded_payment;
    public ?UsersSharedDto                    $users_shared;
    public ?ChatSharedDto                     $chat_shared;
    public ?string                            $connected_website;
    public ?WriteAccessAllowedDto             $write_access_allowed;
    public ?PassportDataDto                   $passport_data;
    public ?ProximityAlertTriggeredDto        $proximity_alert_triggered;
    public ?ChatBoostAddedDto                 $boost_added;
    public ?ChatBackgroundDto                 $chat_background_set;
    public ?ForumTopicCreatedDto              $forum_topic_created;
    public ?ForumTopicEditedDto               $forum_topic_edited;
    public ?ForumTopicClosedDto               $forum_topic_closed;
    public ?ForumTopicReopenedDto             $forum_topic_reopened;
    public ?GeneralForumTopicHiddenDto        $general_forum_topic_hidden;
    public ?GeneralForumTopicHiddenDto        $general_forum_topic_unhidden;
    public ?GiveawayCreatedDto                $giveaway_created;
    public ?GiveawayDto                       $giveaway;
    public ?GiveawayWinnersDto                $giveaway_winners;
    public ?GiveawayCompletedDto              $giveaway_completed;
    public ?VideoChatScheduledDto             $video_chat_scheduled;
    public ?VideoChatStartedDto               $video_chat_started;
    public ?VideoChatEndedDto                 $video_chat_ended;
    public ?VideoChatParticipantsInvitedDto   $video_chat_participants_invited;
    public ?WebAppDataDto                     $web_app_data;
    public ?InlineKeyboardMarkupDto           $reply_markup;
}