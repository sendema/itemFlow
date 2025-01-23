<?php

namespace App\Http\Requests;

use App\Services\ProductService;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function rules(): array
    {
        $rules = [
            'name' => 'required|min:10',
            'status' => 'required|in:available,unavailable',
            'data' => 'required|array',
            'data.color' => 'required|string',
            'data.size' => 'required|string',
        ];

        if ($this->isMethod('post') || $this->productService->canEditArticle()) {
            $rules['article'] = [
                'required',
                'regex:/^[a-zA-Z0-9]+$/',
                'unique:products,article,' . ($this->product ? $this->product->id : '')
            ];
        }

        return $rules;
    }

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
