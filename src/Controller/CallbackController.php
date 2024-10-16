<?php

namespace Controller;

use CallbackHandler\CallbackHandlerInterface;

class CallbackController
{
    private $handler;

    public function __construct(CallbackHandlerInterface $handler)
    {
        $this->handler = $handler;
    }

    public function processButton($chatId, $text, $messageId)
    {

        $this->handler->handleCallback($chatId, $text, $messageId);
    }
}