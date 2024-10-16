<?php

namespace MessageHandler;

use Constants\CallbackConstants;
use TelegramBot\Api\Types\Inline\InlineKeyboardMarkup;
use TelegramBot\Api\Types\Message;

class MessageHandler implements MessageHandlerInterface
{
    private $bot;

    public function __construct($bot)
    {
        $this->bot = $bot;
    }

    public function handleMessage(Message $message)
    {
        $chatId = $message->getChat()->getId();
        switch ($message->getText()) {
            case '/start':
                $this->sendWelcomeMessage($chatId);
                break;

            case '/help':
                $this->sendHelpMessage($chatId);
                break;

            default:
                $this->sendUnknownMessage($chatId);
                break;
        }
    }



    public function sendWelcomeMessage($chatId)
    {
        $keyboard = new InlineKeyboardMarkup([
            [
                ['text' => 'Выбор вина', 'callback_data' => CallbackConstants::WineChoice]
            ],
            [
                ['text' => 'Новинки', 'callback_data' => CallbackConstants::WineNew]
            ],
            [
                ['text' => 'Запись на дегустацию', 'callback_data' => CallbackConstants::Degust]
            ],
            [
                ['text' => 'Факты о виноделии', 'callback_data' => CallbackConstants::WineFacts]
            ],
            [
                ['text' => 'Меню', 'callback_data' => CallbackConstants::Menu]
            ]
        ]);

        // Отправка сообщения с inline-кнопками
        $this->bot->sendMessage($chatId, "Приветствую! 🍷 Я - ваш электронный помощник.
И сегодня я помогу вам с выбором вина! 

Выбирайте то, что подходит именно вам, и доверьте мне заботу о вашем винном опыте! 🍇🥂", null, false, null, $keyboard);
    }

    public function sendHelpMessage($chatId)
    {
        // Логика отправки сообщения с помощью
        $this->bot->sendMessage($chatId, "не реализовано");
    }

    public function sendUnknownMessage($chatId)
    {
        // Логика отправки сообщения о неизвестной команде
        $this->bot->sendMessage($chatId, "Я не знаю такой команды.");
    }
}