<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::available()->latest()->get();
        return response()->json($products);
    }
}
