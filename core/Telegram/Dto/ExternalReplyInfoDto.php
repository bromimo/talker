<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\CastWith;
use core\Telegram\Dto\MessageOrigin\MessageOriginCaster;
use core\Telegram\Dto\MessageOrigin\MessageOriginInterface;

final class ExternalReplyInfoDto extends DataTransferObject
{
    #[CastWith(MessageOriginCaster::class)]
    public MessageOriginInterface $origin;

    public ?ChatDto               $chat;
    public ?int                   $message_id;
    public ?LinkPreviewOptionsDto $link_preview_options;
    public ?AnimationDto          $animation;
    public ?AudioDto              $audio;
    public ?DocumentDto           $document;
    public ?PaidMediaInfoDto      $paid_media;
    /** @var PhotoSizeDto[] */
    public ?array              $photo;
    public ?StickerDto         $sticker;
    public ?StoryDto           $story;
    public ?VideoDto           $video;
    public ?VideoNoteDto       $video_note;
    public ?VoiceDto           $voice;
    public ?bool               $has_media_spoiler;
    public ?ContactDto         $contact;
    public ?DiceDto            $dice;
    public ?GameDto            $game;
    public ?GiveawayDto        $giveaway;
    public ?GiveawayWinnersDto $giveaway_winners;
    public ?InvoiceDto         $invoice;
    public ?LocationDto        $location;
    public ?PollDto            $poll;
    public ?VenueDto           $venue;
}