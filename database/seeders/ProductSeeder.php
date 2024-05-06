<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Cria 5 categorias
        $categories = Category::factory()->count(5)->create();

        // Cria 50 produtos e associa cada um a algumas das categorias criadas
        Product::factory()
            ->count(50)
            ->hasAttached($categories->random(rand(1, 3)))
            ->create();
    }
}