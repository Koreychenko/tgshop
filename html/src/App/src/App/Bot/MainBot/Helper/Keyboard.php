<?php
declare(strict_types=1);

namespace App\Bot\MainBot\Helper;

use Spatie\Emoji\Emoji;
use TgShop\Command\Element\KeyboardButton;
use TgShop\Command\Element\ReplyKeyboardMarkup;
use TgShop\Command\Element\ReplyKeyboardRow;

class Keyboard
{
    public static function getMainKeyboard(): ReplyKeyboardMarkup
    {
        $keyboard = new ReplyKeyboardMarkup();
        $keyboard->setResizeKeyboard(true);

        $row = (new ReplyKeyboardRow())->addButton(new KeyboardButton(Emoji::CHARACTER_PACKAGE . 'Товары'))->addButton(new KeyboardButton(Emoji::CHARACTER_GEAR . 'Настройки'));
        $keyboard->addRow($row);

        $row = (new ReplyKeyboardRow())->addButton(new KeyboardButton(Emoji::CHARACTER_SHOPPING_CART . 'Корзина'))->addButton(new KeyboardButton(Emoji::CHARACTER_DOLLAR_BANKNOTE . 'Мои заказы'));
        $keyboard->addRow($row);

        return $keyboard;
    }
}