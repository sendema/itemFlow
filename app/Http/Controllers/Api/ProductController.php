<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

/**
 * API контроллер для управления продуктами
 */
class ProductController extends Controller
{
    /**
     * Получение списка доступных продуктов с пагинацией
     * GET /api/products
     *
     * @return JsonResponse Список продуктов с пагинацией
     */
    public function index(): JsonResponse
    {
        $products = Product::available()->latest()->paginate(20);
        return response()->json($products);
    }
}
