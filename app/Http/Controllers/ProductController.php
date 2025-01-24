<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

/**
 * Контроллер для управления продуктами
 */
class ProductController extends Controller
{
    /**
     * Конструктор контроллера
     * Регистрация middleware для проверки прав на редактирование артикула
     */
    public function __construct()
    {
        $this->middleware('check.article.edit')->only('update');
    }

    /**
     * Отображение списка продуктов с пагинацией
     * GET /products
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Отображение формы создания продукта
     * GET /products/create
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Сохранение нового продукта
     * POST /products
     *
     * @param ProductRequest $request Валидированный запрос
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully');

    }

    /**
     * Отображение информации о продукте
     * GET /products/{product}
     *
     * @param Product $product
     * @return \Illuminate\View\View
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Отображение формы редактирования продукта
     * GET /products/{product}/edit
     *
     * @param Product $product
     * @return \Illuminate\View\View
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Обновление продукта
     * PUT/PATCH /products/{product}
     *
     * @param ProductRequest $request Валидированный запрос
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * Удаление продукта
     * DELETE /products/{product}
     *
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}
