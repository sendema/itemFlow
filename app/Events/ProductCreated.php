<?php

namespace App\Events;

use App\Models\Product;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Событие создания продукта
 */
class ProductCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $product;

    /**
     * @param Product $product Созданный продукт
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }
}
