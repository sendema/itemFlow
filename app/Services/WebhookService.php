<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Http;

/**
 * Сервис для отправки webhook-уведомлений
 */
class WebhookService
{
    /**
     * URL для отправки webhook-уведомлений
     */
    private string $webhookUrl;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->webhookUrl = config('products.webhook');
    }

    /**
     * Отправка информации о последнем созданном продукте через webhook
     *
     * @throws \Exception Если продукт не найден или webhook не отвечает
     * @return bool
     */
    public function sendLatestProduct(): bool
    {
        $product = Product::latest('id')->first();

        if (!$product) {
            throw new \Exception('No products found');
        }

        $response = Http::post($this->webhookUrl, [
            'product' => $product->toArray()
        ]);

        if (!$response->successful()) {
            throw new \Exception('Webhook failed: ' . $response->status());
        }

        return true;
    }
}
