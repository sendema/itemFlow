<?php

namespace App\Services;

class ProductService
{
    public function canEditArticle(): bool
    {
        return config('products.role') === 'admin';
    }
}
