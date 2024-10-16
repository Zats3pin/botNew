<?php

namespace Controller;

use MessageHandler\MessageHandlerInterface;

class MessageController
{
    private $handler;

    public function __construct(MessageHandlerInterface $handler)
    {
        $this->handler = $handler;
    }

    public function processMessage($chatId, $text)
    {

        $this->handler->handleMessage($chatId, $text);
    }
}