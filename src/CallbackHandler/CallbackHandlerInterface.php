<?php

namespace CallbackHandler;

interface CallbackHandlerInterface
{
    public function handleCallback($chatId, $callback, $messageId);


    public function wineFacts($chatId);

    public function degust($chatId);
    public function wineNew($chatId);
    public function wineChoice($chatId);
    public function wineChoiceMore($chatId, $messageId);
    public function wineChoiceMoreBack($chatId, $messageId);
    public function whiteChoice($chatId);
    public function redChoice($chatId);
    public function pinkChoice($chatId);
    public function sparklingChoice($chatId);

}