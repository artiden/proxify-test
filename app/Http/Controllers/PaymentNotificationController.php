<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Xsolla\SDK\Exception\Webhook\InvalidUserException;
use Xsolla\SDK\Exception\Webhook\XsollaWebhookException;
use Xsolla\SDK\Webhook\Message\Message;
use Xsolla\SDK\Webhook\WebhookRequest;
use Xsolla\SDK\Webhook\WebhookServer;

class PaymentNotificationController extends Controller
{
    public function handle(Request $request)
    {
        return response(null, 204);
        $webhookServer = WebhookServer::create(function (Message $message)
        {
            switch ($message->getNotificationType()) {
                case Message::USER_VALIDATION:
                if (2 !== $message->getUserId()) {
                    throw new InvalidUserException();
                }
                break;
                default:
                    throw new XsollaWebhookException();
                    break;
            }
            return response(null, 204);
        },
        false
        );
        $webhookServer->start(null, false);
    }
}
