<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Inertia\Inertia;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return Inertia::render('Products/ProductsIndex', ['products' => $products]);
    }

    public function show($id)
    {
        $product = Product::find($id);

        return Inertia::render('Products/ProductsShow', ['product' => $product]);
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        $request->user()->fill($request->validated());

        $product = Product::find($id);

        $product->update($request->validated());

        return redirect()->route('products.show', ['id' => $id]);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        $product->delete();

        return redirect()->route('products.index');
    }
}
