<?php

namespace Tests\Feature;

use App\Events\ProductCreated;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

/**
 * Тесты для функционала продуктов
 */
class ProductTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    }
    /**
     * Тестовые данные продукта
     */
    private array $productData = [
        'name' => 'Test Product Name',
        'article' => 'TEST123',
        'status' => 'available',
        'data' => [
            'color' => 'red',
            'size' => 'M'
        ]
    ];

    /**
     * Тест просмотра списка продуктов
     */
    public function test_can_view_products_list(): void
    {
        $product = Product::factory()->create();

        $response = $this->get(route('products.index'));

        $response->assertStatus(200)
            ->assertViewIs('products.index')
            ->assertSee($product->name);
    }

    /**
     * Тест создания продукта
     */
    public function test_can_create_product(): void
    {
        Event::fake();

        $this->mock(ProductService::class)
            ->shouldReceive('canEditArticle')
            ->andReturn(true);

        $response = $this->post(route('products.store'), $this->productData);

        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseHas('products', [
            'name' => $this->productData['name'],
            'article' => $this->productData['article']
        ]);

        Event::assertDispatched(ProductCreated::class);
    }

    /**
     * Тест обновления продукта
     */
    public function test_can_update_product(): void
    {
        $product = Product::factory()->create();
        $updatedData = $this->productData;
        $updatedData['name'] = 'Updated Name';

        $this->mock(ProductService::class)
            ->shouldReceive('canEditArticle')
            ->andReturn(true);

        $response = $this->put(route('products.update', $product), $updatedData);

        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Name'
        ]);
    }

    /**
     * Тест запрета обновления артикула без прав
     */
    public function test_cannot_update_article_without_permission(): void
    {
        $product = Product::factory()->create(['article' => 'OLD123']);
        $updatedData = $this->productData;
        $updatedData['article'] = 'NEW123';

        $this->mock(ProductService::class)
            ->shouldReceive('canEditArticle')
            ->andReturn(false);

        $response = $this->withoutMiddleware()
            ->put(route('products.update', $product), $updatedData);

        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'article' => 'OLD123'
        ]);
    }

    /**
     * Тест удаления продукта
     */
    public function test_can_delete_product(): void
    {
        $product = Product::factory()->create();

        $response = $this->delete(route('products.destroy', $product));

        $response->assertRedirect(route('products.index'));
        $this->assertSoftDeleted($product);
    }

    /**
     * Тест валидации данных продукта
     */
    public function test_product_validation_fails_with_invalid_data(): void
    {
        $invalidData = [
            'name' => 'Short', // Менее 10 символов
            'status' => 'invalid_status',
            'data' => 'not_an_array'
        ];

        $response = $this->post(route('products.store'), $invalidData);

        $response->assertSessionHasErrors(['name', 'status', 'data']);
    }
}
