<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryUpdateRequest;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Illuminate\Http\RedirectResponse;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryController extends Controller
{
    public function index ()
    {
        return response()->json([
            'categories' => Category::all()
        ]);
    }

    public function show(int $id): InertiaResponse
    {
        $category = Category::find($id);

        return Inertia::render('Products/CategoryShow', ['category' => $category]);
    }

    public function update(CategoryUpdateRequest $request, int $id): RedirectResponse
    {
        $request->user()->fill($request->validated());

        $category = Category::find($id);

        $category->update($request->validated());

        return redirect()->route('categories.show', ['id' => $id]);
    }

    public function destroy(int $id): InertiaResponse
    {
        try {
            $category = Category::find($id);
            if ($category){
                $category->delete();
            }
            return Inertia('Products/ProductsIndex', 
                [
                    'initialTab' => 'categories', 
                    'products' => Product::all()
                ]);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('error', ['message' => 'Categoria não encontrada']);
        }
    }
}
