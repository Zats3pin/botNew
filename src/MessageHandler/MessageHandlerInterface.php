<?php

namespace MessageHandler;

interface MessageHandlerInterface
{
    public function handleMessage($chatId, $text);
    public function sendWelcomeMessage($chatId);
    public function sendHelpMessage($chatId);
    public function sendUnknownMessage($chatId);
}