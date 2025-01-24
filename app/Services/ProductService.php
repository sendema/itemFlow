<?php

namespace App\Services;

/**
 * Сервис для работы с продуктами
 */
class ProductService
{
    /**
     * Проверка прав на редактирование артикула
     *
     * @return bool
     */
    public function canEditArticle(): bool
    {
        return config('products.role') === 'admin';
    }
}
