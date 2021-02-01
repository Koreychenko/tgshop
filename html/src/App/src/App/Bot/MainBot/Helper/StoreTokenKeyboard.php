<?php
declare(strict_types=1);

namespace App\Bot\MainBot\Helper;

use Spatie\Emoji\Emoji;
use TgShop\Command\Element\InlineKeyboardButton;
use TgShop\Command\Element\InlineKeyboardMarkup;
use TgShop\Command\Element\InlineKeyboardRow;

class StoreTokenKeyboard
{
    public static function getKeyboard(int $tokenId, bool $isActive = true): InlineKeyboardMarkup
    {
        $keyboard = new InlineKeyboardMarkup();

        $keyboard->addRow(
            (new InlineKeyboardRow())
                ->addButton(
                    (new InlineKeyboardButton(
                        $isActive ?
                            Emoji::CHARACTER_PAUSE_BUTTON . ' ' . 'Pause' :
                            Emoji::CHARACTER_PLAY_BUTTON . ' ' . 'Activate'
                    ))
                        ->setCallbackData('token_pause?id=' . $tokenId)
                )
                ->addButton(
                    (new InlineKeyboardButton(Emoji::CHARACTER_CROSS_MARK . ' ' . 'Remove'))
                        ->setCallbackData('token_delete?id=' . $tokenId)
                )
        );

        return $keyboard;
    }
}