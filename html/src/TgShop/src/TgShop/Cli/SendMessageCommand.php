<?php
declare(strict_types=1);

namespace TgShop\Cli;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TgShop\BotProviderInterface;
use TgShop\Command\Element\InlineKeyboardButton;
use TgShop\Command\Element\InlineKeyboardMarkup;
use TgShop\Command\Element\InlineKeyboardRow;
use TgShop\Command\SendMessage;

class SendMessageCommand extends Command
{
    protected BotProviderInterface $botProvider;

    public function __construct(BotProviderInterface $botProvider)
    {
        $this->botProvider = $botProvider;

        parent::__construct('bot:sendMessage');
    }

    protected function configure()
    {
        $this->addArgument(
            'bot_id',
            InputArgument::REQUIRED,
            'Bot unique id',
        );

        $this->addArgument(
            'chat_id',
            InputArgument::REQUIRED,
            'Chat id',
        );

        $this->addArgument(
            'text',
            InputArgument::REQUIRED,
            'Text',
        );
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $text = $input->getArgument('text');
        $botId   = $input->getArgument('bot_id');
        $chatId  = $input->getArgument('chat_id');
        $inlineKeyboard = (new InlineKeyboardMarkup())
            ->addRow(
                (new InlineKeyboardRow())
                    ->addButton(new InlineKeyboardButton('test1 row1', 'http://google.com'))
                    ->addButton(new InlineKeyboardButton('test2 row1', 'http://google.com'))
            )
            ->addRow(
                (new InlineKeyboardRow())
                    ->addButton(new InlineKeyboardButton('test1 row2', 'http://google.com'))
                    ->addButton(new InlineKeyboardButton('test2 row2', 'http://google.com'))
            );

        $sendMessageCommand = new SendMessage(
            (int) $chatId,
            $text,
            null,
            null,
            null,
            null,
            null,
            null,
            $inlineKeyboard,
        );

        $bot = $this->botProvider->getBot($botId);

        if (!$bot) {
            return 0;
        }

        $bot->send($sendMessageCommand);

        return 0;
    }
}