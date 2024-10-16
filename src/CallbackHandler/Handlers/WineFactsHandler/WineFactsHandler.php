<?php

namespace CallbackHandler\Handlers\WineFactsHandler;

class WineFactsHandler implements WineFactsHandlerInterface
{
    private $bot;
    private $facts = ["Facts1", "Facts2", "Facts3", "Facts4","Facts5", "Facts6"];


    public function __construct($bot)
    {
        $this->bot = $bot;
        shuffle($this->facts);
    }

    public function getFactsWine($chatId) //будет работа с db
    {
        if (count($this->facts) > 1){
            $lastFact = count($this->facts) - 1;
            $randomFact = $this->facts[$lastFact];
            unset($this->facts[$lastFact]);
        $this->bot->sendMessage($chatId, $randomFact);
        }else{
            $this->bot->sendMessage($chatId, "На сегодня фактов нет");
        }
    }
}