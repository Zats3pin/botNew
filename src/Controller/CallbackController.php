<?php

namespace Controller;

use CallbackHandler\CallbackHandlerInterface;
use TelegramBot\Api\Types\Update;

class CallbackController
{
    private $handler;

    public function __construct(CallbackHandlerInterface $handler)
    {
        $this->handler = $handler;
    }

    public function processButton(Update $update)
    {

        $this->handler->handleCallback($update);
    }
}