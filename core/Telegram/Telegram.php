<?php

namespace core\Telegram;

use Exception;
use GuzzleHttp\Client;
use core\Monolog\Monolog;
use core\Abstracts\Singleton;
use core\Telegram\Dto\UserDto;
use core\Telegram\Dto\UpdateDto;
use core\Telegram\Components\Message;
use core\Telegram\Dto\MaybeInaccessibleMessage\MessageDto;
use GuzzleHttp\Exception\GuzzleException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class Telegram extends Singleton
{
    protected Client $client;
    protected string $token;

    public UpdateDto  $webhook;
    public int|string $chat_id;

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
     * @return array
     * @throws Exception
     */
    private function request(string $method, string $uri, array $options = []): array
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
     * @return Telegram
     * @throws UnknownProperties
     */
    public function handleWebhook(): self
    {
        $json = file_get_contents("php://input");
        Monolog::info($json);

        return $this->mapWebhook($json);
    }

    /** Обработка ручного вебхука.
     * @param string $json
     * @return $this
     * @throws UnknownProperties
     */
    public function mapWebhook(string $json): self
    {
        $data = json_decode($json, true);
        $this->webhook = new UpdateDto($data);
        $this->chat_id = $this->getChatId();

        return $this;
    }

    private function getChatId(): int|string
    {
        return $this->webhook->message->chat->id ?? $this->webhook->callback_query->message->chat->id ?? '';
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
}
