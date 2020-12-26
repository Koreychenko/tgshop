<?php
declare(strict_types=1);

namespace TgShop\Cli;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TgShop\BotProviderInterface;
use TgShop\Command\DeleteWebhook;
use TgShop\Command\SetWebhook;
use TgShop\Model\CommandCollection;
use TgShop\Model\CommandCollectionItem;
use TgShop\Transport\SenderInterface;

class SetWebhookCommand extends Command
{
    protected BotProviderInterface $botProvider;

    protected SenderInterface      $sender;

    public function __construct(BotProviderInterface $botProvider, SenderInterface $sender)
    {
        $this->botProvider = $botProvider;
        $this->sender      = $sender;

        parent::__construct('bot:setWebhook');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $bot = $this->botProvider->getBot($input->getArgument('bot_id'));

        if (!$bot) {
            return 0;
        }

        $commandCollection = new CommandCollection();
        $commandCollection->addCommand(new CommandCollectionItem(new DeleteWebhook(), $bot));
        $commandCollection->addCommand(new CommandCollectionItem(new SetWebhook($input->getArgument('uri')), $bot));

        $this->sender->send($commandCollection);

        return 0;
    }

    protected function configure()
    {
        $this->addArgument(
            'bot_id',
            InputArgument::REQUIRED,
            'Bot unique id',
        );

        $this->addArgument(
            'uri',
            InputArgument::REQUIRED,
            'Webhook URI',
        );
    }
}