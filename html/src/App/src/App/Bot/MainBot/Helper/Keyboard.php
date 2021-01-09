<?php
declare(strict_types=1);

namespace App\Bot\MainBot\Helper;

use Spatie\Emoji\Emoji;
use TgShop\Command\Element\InlineKeyboardButton;
use TgShop\Command\Element\InlineKeyboardMarkup;
use TgShop\Command\Element\InlineKeyboardRow;
use TgShop\Command\Element\KeyboardButton;
use TgShop\Command\Element\ReplyKeyboardMarkup;
use TgShop\Command\Element\ReplyKeyboardRow;

class Keyboard
{
    public static function getMainKeyboard(): ReplyKeyboardMarkup
    {
        $keyboard = new ReplyKeyboardMarkup();
        $keyboard->setResizeKeyboard(true);

        $row = (new ReplyKeyboardRow())
            ->addButton(new KeyboardButton(Emoji::CHARACTER_CONVENIENCE_STORE . ' ' . 'Stores'))
            ->addButton(new KeyboardButton('⚙' . ' ' . 'Settings'));
        $keyboard->addRow($row);

        $row = (new ReplyKeyboardRow())
            ->addButton(new KeyboardButton(Emoji::CHARACTER_BAR_CHART . ' ' . 'Statistics'))
            ->addButton(new KeyboardButton(Emoji::CHARACTER_DOLLAR_BANKNOTE . ' ' . 'All orders'));
        $keyboard->addRow($row);

        return $keyboard;
    }

    public static function getNoStoreKeyboard(): ReplyKeyboardMarkup
    {
        $keyboard = new ReplyKeyboardMarkup();
        $keyboard->setResizeKeyboard(true);

        $row = (new ReplyKeyboardRow())
            ->addButton(new KeyboardButton(Emoji::CHARACTER_PLUS . ' ' . 'Add store'))
            ->addButton(new KeyboardButton(Emoji::CHARACTER_GEAR . ' ' . 'Settings'));
        $keyboard->addRow($row);

        return $keyboard;
    }

    public static function getSettingsKeyboard(): InlineKeyboardMarkup
    {
        $settings = [
            'language' => 'Switch Language',
        ];

        $keyboard = new InlineKeyboardMarkup();

        foreach ($settings as $settingPath => $settingName) {
            $row = new InlineKeyboardRow();
            $row->addButton(
                (new InlineKeyboardButton($settingName))
                    ->setCallbackData('settings?option=' . $settingPath)
            );
            $keyboard->addRow($row);
        }

        return $keyboard;
    }

    public static function getSwitchLanguageKeyboard(): InlineKeyboardMarkup
    {
        $supportedLanguages = [
            'en' => 'English',
            'ru' => 'Russian',
        ];

        $keyboard = new InlineKeyboardMarkup();

        foreach ($supportedLanguages as $languageCode => $languageName) {
            $row = new InlineKeyboardRow();
            $row->addButton((new InlineKeyboardButton(Emoji::countryFlag($languageCode) . ' ' . $languageName))->setCallbackData('switch_language?lang=' . $languageCode));
            $keyboard->addRow($row);
        }

        return $keyboard;
    }
}