<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all()->load('categories');

        return Inertia::render('Products/ProductsIndex', ['products' => $products]);
    }

    public function show(int $id): InertiaResponse
    {
        $product = Product::find($id);

        return Inertia::render('Products/ProductsShow', ['product' => $product]);
    }

    public function update(ProductUpdateRequest $request, int $id): RedirectResponse
    {
        $request->user()->fill($request->validated());

        $product = Product::find($id);

        $product->update($request->validated());

        return redirect()->route('products.show', ['id' => $id]);
    }

    public function destroy(int $id): RedirectResponse
    {
        $product = Product::find($id);

        $product->delete();

        return redirect()->route('products.index');
    }
}
