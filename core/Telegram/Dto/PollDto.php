<?php

namespace core\Telegram\Dto;

use Spatie\DataTransferObject\DataTransferObject;

final class PollDto extends DataTransferObject
{
    public string $id;
    public string $question;
    /** @var PollOptionDto[] */
    public array  $options;
    public int    $total_voter_count;
    public bool   $is_closed;
    public bool   $is_anonymous;
    public string $type;
    public bool   $allows_multiple_answers;
    /** @var MessageEntityDto[] */
    public ?array  $question_entities;
    public ?int    $correct_option_id;
    public ?string $explanation;
    /** @var MessageEntityDto[] */
    public ?array $explanation_entities;
    public ?int   $open_period;
    public ?int   $close_date;
}