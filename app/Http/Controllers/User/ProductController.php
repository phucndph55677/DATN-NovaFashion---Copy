<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {

    }


    public function show($id)
    {
        $product = Product::with(['variants.size', 'variants.color'])->findOrFail($id);

        $price = $product->variants->first()?->price ?? 0;
        $sale = $product->variants->first()?->sale;

        // Lấy danh sách size & color duy nhất từ các variants
        $sizes = $product->variants->pluck('size')->unique('id')->filter();
        $colors = $product->variants->pluck('color')->unique('id')->filter();

        return view('client.products.show', compact('product', 'sizes', 'colors', 'price', 'sale'));
    }


    public function create() {}
    public function store(Request $request) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}
