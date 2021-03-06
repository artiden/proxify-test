<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Monolog\Logger;
use Xsolla\SDK\Exception\Webhook\InvalidUserException;
use Xsolla\SDK\Exception\Webhook\XsollaWebhookException;
use Xsolla\SDK\Webhook\Message\Message;
use Xsolla\SDK\Webhook\WebhookRequest;
use Xsolla\SDK\Webhook\WebhookResponse;
use Xsolla\SDK\Webhook\WebhookServer;

class PaymentNotificationController extends Controller
{
    public function handle(Request $request)
    {
        $webhookServer = WebhookServer::create(function (Message $message)
        {
            \logger()
                ->debug($message->getNotificationType());
            switch ($message->getNotificationType()) {
                case Message::USER_VALIDATION:
                if ('2' !== $message->getUserId()) {
                    throw new InvalidUserException();
                }
                return new WebhookResponse(200, '{}');
                break;
                case Message::PAYMENT:
                    if ('2' !== $message->getUserId()) {
                        throw new InvalidUserException();
                    }
                    return new WebhookResponse(200, '{}');
                    break;
                default:
                    throw new XsollaWebhookException();
                    break;
            }
        },
        'pvpw8SBluZAdcjSi',
        );
        $webhookServer->start(null, false);
    }
}
