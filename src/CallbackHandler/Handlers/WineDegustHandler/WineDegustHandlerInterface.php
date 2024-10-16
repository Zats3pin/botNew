<?php

namespace CallbackHandler\Handlers\WineDegustHandler;

use CallbackHandler\Handlers\WineDegustHandler\DegustItem\DegustItem;

interface WineDegustHandlerInterface
{
    public function __construct($bot);
    public function getDegustItem(DegustItem $item, $chatId, $totalItems);

    public function getDegustCallback($chatId);


}