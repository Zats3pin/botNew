<?php

namespace CallbackHandler\Handlers\WineMenuHandler;

use Constants\CallbackConstants;

class WineMenuHandler implements WineMenuHandlerInterface
{
    private $bot;

    public function __construct($bot)
    {
        $this->bot = $bot;
    }

    public function getMenuWine($chatId)
    {
        $this->bot->sendMessage($chatId, CallbackConstants::MENUWINE);
    }
}