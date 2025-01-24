<?php

namespace App\Console\Commands;

use App\Services\WebhookService;
use Illuminate\Console\Command;

class SendLatestProductWebhook extends Command
{
    protected $signature = 'products:webhook';
    protected $description = 'Send latest product data to webhook';

    public function handle(WebhookService $webhookService)
    {
        try {
            $webhookService->sendLatestProduct();
            $this->info('Webhook sent successfully');
            return 0;
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return 1;
        }
    }
}
