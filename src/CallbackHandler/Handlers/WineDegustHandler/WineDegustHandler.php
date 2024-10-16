<?php

namespace CallbackHandler\Handlers\WineDegustHandler;

use CallbackHandler\Handlers\WineDegustHandler\DegustItem\DegustItem;
use TelegramBot\Api\Types\Inline\InlineKeyboardMarkup;

class WineDegustHandler implements WineDegustHandlerInterface
{
    private $bot;
    private $degustItems;
    private $TotalItems;

    public function __construct($bot)
    {
        $this->bot = $bot;
        $this->degustItems = [
            new DegustItem(
                "Wine Tasting 1",
                "https://ucare.timepad.ru/7782cae8-78b5-4b68-b72a-c90a250522ef/poster_event_1669274.jpg",
                "Description 1",
                "2024-10-25",
                "18:00",
                1

            ),
            new DegustItem(
                "Wine Tasting 2",
                "https://ucare.timepad.ru/7782cae8-78b5-4b68-b72a-c90a250522ef/poster_event_1669274.jpg",
                "Description 2",
                "2024-10-25",
                "18:02",
                2
            ),
            new DegustItem(
                "Wine Tasting 3",
                "https://ucare.timepad.ru/7782cae8-78b5-4b68-b72a-c90a250522ef/poster_event_1669274.jpg",
                "Description 3",
                "2024-10-25",
                "18:03",
                3
            ),
        ];
        $this->TotalItems = count($this->degustItems);
    }

    public function getDegustItem(DegustItem $item, $chatId, $totalItems)
    {
        // Формируем сообщение с информацией
        $caption = "Title: " . $item->getTitle() . "\n" .
            "Date: " . $item->getDate() . "\n" .
            "Time: " . $item->getTime() . "\n" .
            "Description: " . $item->getDescription(). "\n" .
            "Number". $item->getNumber() . "/" . $totalItems;

        try {
            // Отправляем фото с описанием
            $this->bot->sendPhoto($chatId, $item->getUrlPhoto(), $caption);

            // Создаем клавиатуру
            $keyboard = new InlineKeyboardMarkup([
                [
                    ['text' => '<-', 'callback_data' => "s"],
                    ['text' => '->', 'callback_data' => "s"]
                ],
                [
                    ['text' => 'Записаться', 'callback_data' => "s"]
                ],
                [
                    ['text' => 'К началу', 'callback_data' => "/start"]
                ],
            ]);

            // Отправляем клавиатуру
            $this->bot->editMessageReplyMarkup($chatId, $item->getMessageId(), $keyboard);
        } catch (\Exception $e) {
            error_log("Ошибка при отправке сообщения: " . $e->getMessage());
        }
    }


    public function getDegustCallback($chatId)
    {
        // Используем $this для доступа к свойствам класса
        $this->getDegustItem($this->degustItems[0], $chatId, $this->TotalItems);
    }
}
