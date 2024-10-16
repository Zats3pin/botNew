<?php

namespace CallbackHandler;

use CallbackHandler\Handlers\WineDegustHandler\WineDegustHandler;
use CallbackHandler\Handlers\WineFactsHandler\WineFactsHandler;
use CallbackHandler\Handlers\WineMenuHandler\WineMenuHandler;
use Constants\CallbackConstants;
use TelegramBot\Api\Types\Inline\InlineKeyboardMarkup;

class CallbackHandler implements CallbackHandlerInterface
{
    private $bot;

    public function __construct($bot)
    {
        $this->bot = $bot;
        $this->wineMenuHandler = new WineMenuHandler($bot);
        $this->wineFactsHandler = new WineFactsHandler($bot);
        $this->wineDegustHandler = new WineDegustHandler($bot);
    }

    public function handleCallback($update)
    {
        $callbackQuery = $update->getCallbackQuery();
        $chatId = $callbackQuery->getMessage()->getChat()->getId();
        $messageId = $callbackQuery->getMessage()->getMessageId();
        $callbackData = $callbackQuery->getData();

        switch ($callbackQuery->getData()) {
            case CallbackConstants::WineChoice:
                $this->wineChoice($chatId);
                break;

            case CallbackConstants::WineNew:
                $this->wineNew($chatId);
                break;

            case CallbackConstants::Degust:
                $this->wineDegustHandler->getDegustCallback($chatId);
                break;

            case CallbackConstants::WineFacts:
                $this->wineFactsHandler->getFactsWine($chatId);
                break;

            case CallbackConstants::Menu:
                $this->wineMenuHandler->getMenuWine($chatId);
                break;

            case CallbackConstants::WineChoiceMore:
                $this->wineChoiceMore($chatId, $messageId);
                break;

            case CallbackConstants::WineChoiceMoreBack:
                $this->wineChoiceMoreBack($chatId, $messageId);
                break;
        }
    }

    public function wineFacts($chatId)
    {
        // To be implemented.
    }

    public function degust($chatId)
    {
        // To be implemented.
    }

    public function wineNew($chatId)
    {
        // To be implemented.
    }

    public function wineChoice($chatId)
    {
        $keyboard = new InlineKeyboardMarkup([
            [
                ['text' => 'Белое', 'callback_data' => CallbackConstants::WineChoice]
            ],
            [
                ['text' => 'Красное', 'callback_data' => CallbackConstants::WineNew]
            ],
            [
                ['text' => 'Розовое', 'callback_data' => CallbackConstants::Degust]
            ],
            [
                ['text' => 'Игристое', 'callback_data' => CallbackConstants::WineFacts]
            ],
            [
                ['text' => 'Подробнее', 'callback_data' => CallbackConstants::WineChoiceMore]
            ]
        ]);

        // Отправка сообщения с inline-кнопками
        $this->bot->sendMessage($chatId, "Выберите тип вина:", null, false, null, $keyboard);
    }

    public function wineChoiceMore($chatId, $messageId)
    {
        $newText = "Белое вино: 😊 Это вино, которое делают из зеленых или желтоватых виноградов. Оно обычно светлое по цвету и имеет свежий и легкий вкус. Белое вино может быть сухим, сладким или полусухим.

    Красное вино: 🍷 Это вино, которое делают из красных виноградов. Оно имеет темно-красный или пурпурный цвет и более насыщенный вкус по сравнению с белым вином. Красное вино может быть сухим, сладким или полусухим.

    Розовое вино: 🌸 Это вино, которое делают из красных виноградов, но оно проходит процесс макерации (контакта с кожицей винограда) только на короткое время, поэтому оно имеет светло-розовый цвет. Вкус розового вина обычно легкий и освежающий, между белым и красным вином.

    Игристое вино: 🥂 Это вино, которое содержит много пузырьков углекислого газа, делающих его искристым и шипучим. Примерами игристых вин являются шампанское и про секко.
    
    Выберите тип вина:"; // Полный текст убран для краткости.

        // Создание массива кнопок
        $keyboard = new InlineKeyboardMarkup([
            [
                ['text' => 'Белое', 'callback_data' => CallbackConstants::WineChoice]
            ],
            [
                ['text' => 'Красное', 'callback_data' => CallbackConstants::WineNew]
            ],
            [
                ['text' => 'Розовое', 'callback_data' => CallbackConstants::Degust]
            ],
            [
                ['text' => 'Игристое', 'callback_data' => CallbackConstants::WineFacts]
            ],
            [
                ['text' => 'Назад', 'callback_data' => CallbackConstants::WineChoiceMoreBack]
            ]
        ]);
        try {
            // Сначала редактируем текст сообщения
            $this->bot->editMessageText($chatId, $messageId, $newText);

            // Затем обновляем клавиатуру
            $this->bot->editMessageReplyMarkup($chatId, $messageId, $keyboard);
        } catch (\Exception $e) {
            error_log("Ошибка при редактировании сообщения: " . $e->getMessage());
        }
    }

    public function wineChoiceMoreBack($chatId, $messageId)
    {

        $newText = "Выберите тип вина:"; // Полный текст убран для краткости.

        // Создание массива кнопок
        $keyboard = new InlineKeyboardMarkup([
            [
                ['text' => 'Белое', 'callback_data' => CallbackConstants::WineChoice]
            ],
            [
                ['text' => 'Красное', 'callback_data' => CallbackConstants::WineNew]
            ],
            [
                ['text' => 'Розовое', 'callback_data' => CallbackConstants::Degust]
            ],
            [
                ['text' => 'Игристое', 'callback_data' => CallbackConstants::WineFacts]
            ],
            [
                ['text' => 'Подробнее', 'callback_data' => CallbackConstants::WineChoiceMore]
            ]
        ]);
        try {
            // Сначала редактируем текст сообщения
            $this->bot->editMessageText($chatId, $messageId, $newText);

            // Затем обновляем клавиатуру
            $this->bot->editMessageReplyMarkup($chatId, $messageId, $keyboard);
        } catch (\Exception $e) {
            error_log("Ошибка при редактировании сообщения: " . $e->getMessage());
        }
    }

    public function whiteChoice($chatId)
    {
        // TODO: Implement whiteChoice() method.
    }

    public function redChoice($chatId)
    {
        // TODO: Implement redChoice() method.
    }

    public function pinkChoice($chatId)
    {
        // TODO: Implement pinkChoice() method.
    }

    public function sparklingChoice($chatId)
    {
        // TODO: Implement sparklingChoice() method.
    }
}
