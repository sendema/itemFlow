<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SendLatestProductWebhook extends Command
{
    protected $signature = 'products:webhook';
    protected $description = 'Send latest product data to webhook';

    public function handle()
    {
        $product = Product::latest('id')->first();

        if (!$product) {
            $this->error('No products found');
            return 1;
        }

        try {
            $response = Http::post(config('products.webhook'), [
                'product' => $product->toArray()
            ]);

            if ($response->successful()) {
                $this->info('Webhook sent successfully');
                return 0;
            }

            $this->error('Webhook failed: ' . $response->status());
            return 1;

        } catch (\Exception $e) {
            $this->error('Error sending webhook: ' . $e->getMessage());
            return 1;
        }
    }
}
