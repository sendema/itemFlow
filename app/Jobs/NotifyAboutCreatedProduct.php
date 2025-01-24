<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

/**
 * Задача для отправки уведомления о создании продукта
 */
class NotifyAboutCreatedProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @param Product $product Созданный продукт
     */
    public function __construct(
        protected Product $product
    ) {}

    /**
     * Выполнение задачи
     *
     * @return void
     */
    public function handle(): void
    {
        Notification::route('mail', config('products.email'))
            ->notify(new \App\Notifications\ProductCreated($this->product));
    }
}
