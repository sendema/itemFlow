<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Jobs\SendProductCreatedNotification;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10); //available
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());

        SendProductCreatedNotification::dispatch($product);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully');

    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        if (!$this->canEditArticle() && $request->has('article')) {
            unset($request['article']);
        }

        $product->update($request->validated());
        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }

    private function canEditArticle()
    {
        return config('products.role') === 'admin';
    }
}
