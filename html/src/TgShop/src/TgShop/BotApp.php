<?php
declare(strict_types=1);

namespace TgShop;

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use TgShop\Middleware\ErrorHandlerMiddleware;
use TgShop\Middleware\MiddlewareInterface;
use TgShop\Middleware\TelegramRequest;
use TgShop\Middleware\TelegramRequestInterface;
use TgShop\Middleware\TelegramResponse;
use TgShop\Middleware\TelegramResponseInterface;
use TgShop\Transport\SenderInterface;
use Throwable;

class BotApp implements BotAppInterface
{
    public const DEFAULT_BOT_ARGUMENT = 'default_bot';

    protected array              $pipeline;

    protected SenderInterface    $sender;

    protected ContainerInterface $container;

    public function __construct(
        array $pipeline,
        SenderInterface $sender,
        ContainerInterface $container
    ) {
        $this->pipeline  = $pipeline;
        $this->sender    = $sender;
        $this->container = $container;
    }

    public function handle(TelegramRequestInterface $telegramRequest): void
    {
        $telegramResponse = new TelegramResponse(
            $telegramRequest->getArgument(BotApp::DEFAULT_BOT_ARGUMENT)
        );

        $pipeline = $this->pipeline;

        try {
            foreach ($pipeline as $key => $pipe) {
                if ($this->container->get('config')['debug']) {
                    if ($this->container->has(LoggerInterface::class)) {
                        /** @var LoggerInterface $logger */
                        $logger = $this->container->get(LoggerInterface::class);

                        $logger->debug('Telegram request log', [
                            'request' => $telegramRequest,
                            'response' => $telegramResponse,
                            'middleware' => $pipe,
                        ]);
                    }
                }

                if (is_string($pipe)) {
                    $pipe = $this->container->get($pipe);
                }

                if ($pipe instanceof MiddlewareInterface) {
                    if (method_exists($pipe, 'setContainer')) {
                        $pipe->setContainer($this->container);
                    }

                    $result = $pipe->handle($telegramRequest, $telegramResponse);

                    /* If middleware returns an object of type TelegramResponseInterface stop
                    further request processing and try to send commands list */
                    if ($result and $result instanceof TelegramResponseInterface) {
                        $this->sender->send($result->getCommands());

                        return;
                    }
                }
            }
        } catch (Throwable $exception) {
            $telegramRequest->setArgument(TelegramRequest::PIPELINE_ERROR, $exception);

            $errorHandlerMiddleware = $this->container->get(ErrorHandlerMiddleware::class);

            $result = $errorHandlerMiddleware->handle($telegramRequest, $telegramResponse);

            /* If middleware returns an object of type TelegramResponseInterface stop
                    further request processing and try to send commands list */
            if ($result and $result instanceof TelegramResponseInterface) {
                $this->sender->send($result->getCommands());

                return;
            }
        }

        $this->sender->send($telegramResponse->getCommands());
    }
}