<?php
declare(strict_types=1);

namespace TgShop\Cli;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TgShop\StaticBotProviderInterface;
use TgShop\Command\DeleteWebhook;
use TgShop\Command\SetWebhook;

class SetWebhookCommand extends Command
{
    protected StaticBotProviderInterface $botProvider;

    public function __construct(StaticBotProviderInterface $botProvider)
    {
        $this->botProvider = $botProvider;

        parent::__construct('bot:setWebhook');
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

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $uri = $input->getArgument('uri');

        $botId = $input->getArgument('bot_id');

        $deleteWebhookCommand = new DeleteWebhook();
        $setWebhookCommand    = new SetWebhook($uri);

        $bot = $this->botProvider->getBot($botId);

        if (!$bot) {
            return 0;
        }

        $bot->send($deleteWebhookCommand);
        $bot->send($setWebhookCommand);

        return 0;
    }
}