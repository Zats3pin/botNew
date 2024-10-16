<?php

namespace MessageHandler;

use TelegramBot\Api\Types\Message;

interface MessageHandlerInterface
{
    public function handleMessage(Message $message);
    public function sendWelcomeMessage($chatId);
    public function sendHelpMessage($chatId);
    public function sendUnknownMessage($chatId);
}