<?php
namespace App\Jobs;

use App\Models\Product;
use App\Notifications\ProductCreated;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendProductCreatedNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(protected Product $product) {}

    public function handle(): void
    {
        Notification::route('mail', config('products.email'))
            ->notify(new ProductCreated($this->product));
    }
}
