<?php

namespace App\Http\Middleware;

use App\Services\ProductService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckArticleEditPermission
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function handle(Request $request, Closure $next): Response
    {
        if ($request->has('article') && !$this->productService->canEditArticle()) {

            return response()->json(['error' => 'Unauthorized to edit article'], 403);

        }

        return $next($request);
    }
}
