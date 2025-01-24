<?php

namespace App\Listeners;

use App\Events\ProductCreated;
use App\Jobs\NotifyAboutCreatedProduct;

/**
 * Слушатель события создания продукта для отправки уведомлений
 */
class ProductCreatedNotificationListener
{
    /**
     * Обработка события создания продукта
     *
     * @param ProductCreated $event Событие создания продукта
     * @return void
     */
    public function handle(ProductCreated $event): void
    {
        NotifyAboutCreatedProduct::dispatch($event->product);
    }
}
