<?php

namespace core\Telegram;

use Exception;
use GuzzleHttp\Client;
use core\Talker\Route;
use core\Monolog\Monolog;
use core\Abstracts\Singleton;
use core\Telegram\Dto\UserDto;
use core\Telegram\Dto\UpdateDto;
use core\Telegram\Components\Photo;
use core\Telegram\Components\Message;
use GuzzleHttp\Exception\GuzzleException;
use core\Telegram\Dto\MaybeInaccessibleMessage\MessageDto;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class Telegram extends Singleton
{
    protected Client $client;
    protected string $token;

    public UpdateDto  $webhook;
    public int|string $chat_id;
    public ?string    $first_name;
    public ?string    $last_name;
    public ?string    $username;

    protected function __construct()
    {
        parent::__construct();
        $this->token = env("TG_BOT_API_KEY");
        $this->client = new Client(['base_uri' => "https://api.telegram.org/bot{$this->token}/"]);
    }

    /** Возвращает токен бота.
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /** Отправляет запрос.
     * @param string $method
     * @param string $uri
     * @param array  $options
     * @return array|bool
     */
    private function request(string $method, string $uri, array $options = []): array|bool
    {
        try {
            $response = $this->client->request($method, $uri, $options);
        } catch (GuzzleException $e) {
            dd($e->getResponse()->getBody()->getContents());
        }

        return json_decode($response->getBody()->getContents(), true)['result'];
    }

    /** Возвращает основную информацию о боте.
     * @return UserDto
     * @throws Exception
     */
    public function getMe(): UserDto
    {
        return new UserDto($this->request('GET', 'getMe'));
    }

    /** Обработка вебхука.
     * @return void
     * @throws UnknownProperties
     */
    public function handleWebhook(): void
    {
        $json = file_get_contents("php://input");
        Monolog::info($json);
        $this->mapWebhook($json);
    }

    /** Обработка ручного вебхука.
     * @param string $json
     * @return void
     * @throws UnknownProperties
     */
    public function mapWebhook(string $json): void
    {
        $data = json_decode($json, true);
        $this->webhook = new UpdateDto($data);
        $this->chat_id = $this->getChatId();
        $this->first_name = $this->getFirstName();
        $this->last_name = $this->getLastName();
        $this->username = $this->getUsername();
        Route::handle($this->webhook);
    }

    private function getChatId(): int|string
    {
        return $this->webhook->message->chat->id ?? $this->webhook->callback_query->message->chat->id ?? '';
    }

    private function getFirstName(): ?string
    {
        return $this->webhook->message->from->first_name ?? $this->webhook->callback_query->from->first_name ?? null;
    }

    private function getLastName(): ?string
    {
        return $this->webhook->message->from->last_name ?? $this->webhook->callback_query->from->last_name ?? null;
    }

    private function getUsername(): ?string
    {
        return $this->webhook->message->from->username ?? $this->webhook->callback_query->from->username ?? null;
    }

    /** Отправляет сообщение в чат.
     * @param Message $message
     * @return MessageDto
     * @throws UnknownProperties
     */
    public static function sendMessage(Message $message): MessageDto
    {
        $tg = Telegram::getInstance();
        $message->chatId($tg->chat_id);
        $result = $tg->request('POST', 'sendMessage', ['json' => $message->toArray()]);
        Monolog::debug('answer', $result);

        return new MessageDto($result);
    }

    /** Удаляет InlineKeyboard предыдущего сообщения.
     * @return void
     * @throws Exception
     */
    public static function hideKeyboard(): void
    {
        $tg = Telegram::getInstance();
        $json = [
            'chat_id' => $tg->chat_id,
            'message_id' => $tg->webhook->callback_query->message->message_id,
        ];
        $tg->request('POST', 'editMessageReplyMarkup', ['json' => $json]);
    }

    /** Удаляет предыдущее сообщение.
     * @return void
     */
    public static function deletePreviousMessage(): void
    {
        $tg = Telegram::getInstance();
        $json = [
            'chat_id' => $tg->chat_id ?? null,
            'message_id' => $tg->webhook->callback_query->message->message_id ?? null,
        ];
        if (is_null($json['chat_id']) || is_null($json['message_id'])) {
            return;
        }
        $tg->request('POST', 'deleteMessage', ['json' => $json]);
    }

    /** Отправляет изображение в чат.
     * @param Photo $photo
     * @return MessageDto
     * @throws UnknownProperties
     */
    public static function sendPhoto(Photo $photo): MessageDto
    {
        $tg = Telegram::getInstance();
        $photo->chatId($tg->chat_id);
        $result = $tg->request('POST', 'sendPhoto', ['json' => $photo->toArray()]);
        Monolog::debug('answer', $result);

        return new MessageDto($result);
    }
}
