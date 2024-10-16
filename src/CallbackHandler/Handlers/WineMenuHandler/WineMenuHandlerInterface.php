<?php

namespace CallbackHandler\Handlers\WineMenuHandler;

interface WineMenuHandlerInterface
{
    public function __construct($bot);
    public function getMenuWine($chatId);
}