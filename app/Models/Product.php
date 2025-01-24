<?php

namespace App\Models;

use App\Events\ProductCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Модель продукта
 *
 * @property string $article Артикул продукта
 * @property string $name Название продукта
 * @property string $status Статус продукта (available/unavailable)
 * @property array $data Дополнительные данные продукта
 */
class Product extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Атрибуты, доступные для массового заполнения
     *
     * @var array<string>
     */
    protected $fillable = [
        'article',
        'name',
        'status',
        'data'
    ];

    /**
     * Приведение типов атрибутов
     *
     * @var array<string, string>
     */
    protected $casts = ['data' => 'array'];


    /**
     * Scope для получения только доступных продуктов
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    /**
     * Регистрация событий модели
     * При создании продукта генерируется событие ProductCreated
     */
    protected static function booted()
    {
        static::created(function ($product) {
            event(new ProductCreated($product));
        });
    }
}
