<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_name()
    {
        $category = Category::factory()->create(['name' => 'Laptops']);

        $this->assertEquals('Laptops', $category->name);
    }

    /** @test */
    public function it_can_have_a_product()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create();

        $category->products()->attach($product->id);

        $this->assertCount(1, $category->products);
    }

    /** @test */
    public function it_can_have_multiple_products()
    {
        $category = Category::factory()->create();
        $product1 = Product::factory()->create();
        $product2 = Product::factory()->create();

        $category->products()->attach([$product1->id, $product2->id]);

        $this->assertCount(2, $category->products);
    }

    /** @test */
    public function it_cannot_be_created_saved_or_updated_without_a_name()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Name cannot be empty');
        Category::factory()->create(['name' => '']);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Name cannot be empty');
        $category = Category::factory()->create(['name' => null]);
        $category->save();

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Name cannot be empty');
        $category = Category::factory()->create();
        $category->update(['name' => '']);        
    }
}
