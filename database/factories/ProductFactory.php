<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    private $russianColors = [
        'Красный', 'Синий', 'Зеленый', 'Желтый', 'Черный',
        'Белый', 'Серый', 'Фиолетовый', 'Оранжевый', 'Коричневый'
    ];

    private $russianNames = [
        'Футболка', 'Джинсы', 'Куртка', 'Рубашка', 'Платье',
        'Свитер', 'Шорты', 'Пальто', 'Юбка', 'Костюм'
    ];

    public function definition()
    {
        $this->faker->addProvider(new \Faker\Provider\ru_RU\Person($this->faker));

        return [
            'article' => strtoupper($this->faker->unique()->bothify('ART-#####-??')),
            'name' => $this->faker->randomElement($this->russianNames) . ' ' . $this->faker->words(2, true),
            'status' => $this->faker->randomElement(['available', 'unavailable']),
            'data' => [
                'color' => $this->faker->randomElement($this->russianColors),
                'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
            ],
        ];
    }
}
