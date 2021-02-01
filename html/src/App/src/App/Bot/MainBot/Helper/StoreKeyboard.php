<?php
declare(strict_types=1);

namespace App\Bot\MainBot\Helper;

use Spatie\Emoji\Emoji;
use TgShop\Command\Element\InlineKeyboardButton;
use TgShop\Command\Element\InlineKeyboardMarkup;
use TgShop\Command\Element\InlineKeyboardRow;

class StoreKeyboard
{
    public static function getKeyboard(int $storeId): InlineKeyboardMarkup
    {
        $keyboard = new InlineKeyboardMarkup();

        $keyboard->addRow(
            (new InlineKeyboardRow())
                ->addButton(
                    (new InlineKeyboardButton(Emoji::CHARACTER_KEY . ' ' . 'Store tokens'))
                        ->setCallbackData('store_tokens?id=' . $storeId)
                )
        );

        $keyboard->addRow(
            (new InlineKeyboardRow())
                ->addButton(
                    (new InlineKeyboardButton(Emoji::CHARACTER_PLUS . ' ' . 'Add token'))
                        ->setCallbackData('store_add_token?id=' . $storeId)
                )
        );

        $keyboard->addRow(
            (new InlineKeyboardRow())
                ->addButton(
                    (new InlineKeyboardButton(Emoji::CHARACTER_PLUS . ' ' . 'Upload price'))
                        ->setCallbackData('upload_price?id=' . $storeId)
                )
        );

        $keyboard->addRow(
            (new InlineKeyboardRow())
                ->addButton(
                    (new InlineKeyboardButton(Emoji::CHARACTER_CROSS_MARK . ' ' . 'Delete'))
                        ->setCallbackData('store_delete?id=' . $storeId)
                )
        );

        return $keyboard;
    }
}