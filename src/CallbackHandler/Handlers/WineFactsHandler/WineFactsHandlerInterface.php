<?php

namespace CallbackHandler\Handlers\WineFactsHandler;

interface WineFactsHandlerInterface
{
    public function __construct($bot);
    public function getFactsWine($chatId);
}