<?php

namespace App\Http\Requests;

use App\Services\ProductService;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Класс валидации запросов для продуктов
 */
class ProductRequest extends FormRequest
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Правила валидации для продукта
     *
     * @return array Массив правил валидации
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|min:10',
            'status' => 'required|in:available,unavailable',
            'data' => 'required|array',
            'data.color' => 'required|string',
            'data.size' => 'required|string',
        ];

        if ($this->isMethod('post') && $this->productService->canEditArticle()) {
            $rules['article'] = [
                'required',
                'regex:/^[a-zA-Z0-9]+$/',
                'unique:products,article,' . ($this->product ? $this->product->id : '')
            ];
        }

        return $rules;
    }

    /**
     * Пользовательские сообщения об ошибках валидации
     *
     * @return array Массив сообщений об ошибках
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Название обязательно для заполнения',
            'name.min' => 'Название должно быть не менее 10 символов',
            'article.required' => 'Артикул обязателен для заполнения',
            'article.regex' => 'Артикул может содержать только латинские буквы и цифры',
            'article.unique' => 'Такой артикул уже существует',
        ];
    }
}
