<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory для создания тестовых продуктов
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Определение структуры данных продукта
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(2),
            'article' => strtoupper($this->faker->unique()->bothify('ART#####')),
            'status' => $this->faker->randomElement(['available', 'unavailable']),
            'data' => [
                'color' => $this->faker->safeColorName(),
                'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL'])
            ]
        ];
    }

    /**
     * Состояние для доступного продукта
     */
    public function available(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'available'
            ];
        });
    }
}
