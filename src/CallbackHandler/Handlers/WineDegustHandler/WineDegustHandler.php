<?php

namespace CallbackHandler\Handlers\WineDegustHandler;

use CallbackHandler\Handlers\WineDegustHandler\DegustItem\DegustItem;
use TelegramBot\Api\Types\Inline\InlineKeyboardMarkup;

class WineDegustHandler implements WineDegustHandlerInterface
{
    private $bot;
    private $degustItems;
    private $TotalItems;
    private $lastMessageId;

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

    public function getDegustCallback($chatId)
    {
        // Используем $this для доступа к свойствам класса
        $this->getDegustItem($this->degustItems[0], $chatId, $this->TotalItems);
    }

    public function getDegustItem(DegustItem $item, $chatId, $totalItems)
    {
        // Формируем сообщение с информацией
        $caption = "Title: " . $item->getTitle() . "\n" .
            "Date: " . $item->getDate() . "\n" .
            "Time: " . $item->getTime() . "\n" .
            "Description: " . $item->getDescription() . "\n" .
            "Number " . $item->getNumber() . "/" . $totalItems;

        // Создаем клавиатуру
        $keyboard = new InlineKeyboardMarkup(
            [
                [
                    ['text' => '<-', 'callback_data' => "prev"],
                    ['text' => '->', 'callback_data' => "next"]
                ],
                [
                    ['text' => 'Записаться', 'callback_data' => "register"]
                ],
                [
                    ['text' => 'К началу', 'callback_data' => "/start"]
                ]
            ]
        );

        try {
            // Логируем попытку отправить сообщение
            error_log("Attempting to send photo to Chat ID: $chatId");

            // Отправляем фото
            $message = $this->bot->sendPhoto(
                $chatId,
                $item->getUrlPhoto(),
                $caption
            );

            if ($message) {
                // Убедитесь, что сообщение успешно отправлено
                error_log("Photo sent successfully to Chat ID: $chatId");

                // Добавляем клавиатуру к отправленному сообщению
                $this->bot->editMessageReplyMarkup(
                    $chatId,
                    $message->getMessageId(),
                    $keyboard // Передаем объект клавиатуры
                );

                error_log("Keyboard added to message ID: " . $message->getMessageId());
            } else {
                error_log("Failed to send photo to Chat ID: $chatId");
            }
        } catch (\Exception $e) {
            error_log("Error sending message: " . $e->getMessage());
        }



}


}
