<?php

namespace App\Providers;

use App\Events\ProductCreated;
use App\Listeners\ProductCreatedNotificationListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

/**
 * Провайдер для регистрации событий приложения
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * События и их слушатели
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        ProductCreated::class => [
            ProductCreatedNotificationListener::class,
        ],
    ];
}
