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
use TgShop\Command\SendPhoto;
use TgShop\Model\CommandCollection;
use TgShop\Model\CommandCollectionItem;
use TgShop\Transport\SenderInterface;

class SendMessageCommand extends Command
{
    protected BotProviderInterface $botProvider;

    protected SenderInterface $sender;

    public function __construct(BotProviderInterface $botProvider, SenderInterface $sender)
    {
        $this->botProvider = $botProvider;
        $this->sender      = $sender;

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
                    ->addButton((new InlineKeyboardButton('test1 row1'))->setCallbackData('callback_data?param1=1&param2=2'))
                    ->addButton((new InlineKeyboardButton('test2 row1'))->setUrl('http://google.com'))
            )
            ->addRow(
                (new InlineKeyboardRow())
                    ->addButton((new InlineKeyboardButton('test1 row2'))->setUrl('http://google.com'))
                    ->addButton((new InlineKeyboardButton('test2 row2'))->setUrl('http://google.com'))
            );

        //$sendMessageCommand = (new SendMessage((int) $chatId, $text))->setReplyMarkup($inlineKeyboard);
        $sendMessageCommand = (new SendPhoto((int) $chatId))
            //->setImagePath('/tmp/test.png')
            ->setReplyMarkup($inlineKeyboard)
            ->setImageUrl('https://www.google.com/logos/doodles/2020/december-holidays-days-2-30-6753651837108830.5-s.png');

        $bot = $this->botProvider->getBot($botId);

        if (!$bot) {
            return 0;
        }

        $commandCollection = new CommandCollection();
        $commandCollection->addCommand(new CommandCollectionItem($sendMessageCommand, $bot));

        $this->sender->send($commandCollection);

        return 0;
    }
}