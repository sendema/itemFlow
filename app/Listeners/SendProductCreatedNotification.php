<?php

namespace App\Listeners;

use App\Events\ProductCreated;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Слушатель события создания продукта
 */
class SendProductCreatedNotification implements ShouldQueue
{
    /**
     * Обработка события создания продукта
     *
     * @param ProductCreated $event Событие создания продукта
     */
    public function handle(ProductCreated $event)
    {
        Notification::route('mail', config('products.email'))
            ->notify(new \App\Notifications\ProductCreated($event->product));
    }
}
