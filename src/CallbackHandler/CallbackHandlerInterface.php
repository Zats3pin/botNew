<?php

namespace CallbackHandler;

use TelegramBot\Api\Types\Update;

interface CallbackHandlerInterface
{
    public function handleCallback(Update $message);
    public function wineFacts($chatId);
    public function degust($chatId);
    public function wineNew($chatId);
    public function wineChoice($chatId);
    public function wineChoiceMore($chatId, $messageId);
    public function wineChoiceMoreBack($chatId, $messageId);
    public function whiteChoice($chatId);
    public function redChoice($chatId);
    public function pinkChoice($chatId);
    public function sparklingChoice($chatId);

}