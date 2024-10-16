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

    public function processMessage($message)
    {

        $this->handler->handleMessage($message);
    }
}