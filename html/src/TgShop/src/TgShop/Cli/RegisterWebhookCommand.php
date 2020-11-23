<?php
declare(strict_types=1);

namespace TgShop\Cli;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TgShop\BotProviderInterface;
use TgShop\Command\SetWebhookCommand;

class RegisterWebhookCommand extends Command
{
    protected BotProviderInterface $botProvider;

    public function __construct(BotProviderInterface $botProvider)
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

        $command = new SetWebhookCommand($uri);

        $bot = $this->botProvider->getBot($botId);

        if (!$bot) {
            return 0;
        }

        $bot->send($command);

        return 0;
    }
}