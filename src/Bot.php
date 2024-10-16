<?php

require_once 'vendor/autoload.php';

use CallbackHandler\CallbackHandler;
use Controller\CallbackController;
use Controller\MessageController;
use MessageHandler\MessageHandler;
use TelegramBot\Api\BotApi;


$config = require __DIR__ . '\Config.php';

// Получаем токен бота из конфигурации
$botToken = $config['telegram_bot_token'];

$bot = new BotApi($botToken);

// Создаем обработчик сообщений
$messageHandler = new MessageHandler($bot);
$callbackHandler = new CallbackHandler($bot);

// Создаем контроллер
$messageController = new MessageController($messageHandler);
$CallbackController = new CallbackController($callbackHandler);

$lastUpdateId = 0;

while (true) {
    // Получаем обновления
    $updates = $bot->getUpdates($lastUpdateId + 1);

    foreach ($updates as $update) {
        if ($update->getCallbackQuery()) {
            // Получаем данные из callback_query
            $callbackQuery = $update->getCallbackQuery();
            $callbackData = $callbackQuery->getData(); // Данные из callback_data
            $chatId = $callbackQuery->getMessage()->getChat()->getId();
            $messageId = $callbackQuery->getMessage()->getMessageId();
            $CallbackController->processButton($chatId,$callbackData,$messageId);
        }
        $message = $update->getMessage();

        $lastUpdateId = $update->getUpdateId();
        if ($message) {
            $chatId = $message->getChat()->getId();
            $text = $message->getText();

            // Передаем сообщение в контроллер
            $messageController->processMessage($chatId, $text);

            // Обновляем ID последнего обновления
            $lastUpdateId = $update->getUpdateId();
        }
    }

    // Пауза между запросами
    sleep(1);
}
