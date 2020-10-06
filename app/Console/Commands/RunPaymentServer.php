<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Xsolla\SDK\Webhook\Message\Message;
use Xsolla\SDK\Webhook\WebhookServer;

class RunPaymentServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'paymentserver:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run payment service';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $callback = function (Message $message)
        {

        };

        $webHookServer = WebhookServer::create($callback, '90625');
        $webHookServer->start(null, false);
    }
}
