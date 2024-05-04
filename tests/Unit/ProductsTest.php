<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;

class ProductsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_be_created_with_valid_attributes()
    {
        $productData = [
            'name' => 'Laptop',
            'description' => 'This is a laptop',
            'price' => 1000
        ];

        $product = Product::create($productData);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals($productData['name'], $product->name);
        $this->assertEquals($productData['description'], $product->description);
        $this->assertEquals($productData['price'], $product->price);
    }

    /** @test */
    public function it_can_be_updated_with_valid_attributes()
    {
        $product = Product::factory()->create();

        $updatedData = [
            'name' => 'Updated Laptop',
            'description' => 'This is an updated laptop',
            'price' => 2000
        ];

        $product->update($updatedData);

        $this->assertEquals($updatedData['name'], $product->fresh()->name);
        $this->assertEquals($updatedData['description'], $product->fresh()->description);
        $this->assertEquals($updatedData['price'], $product->fresh()->price);
    }

    /** @test */
    public function it_can_have_multiple_categories()
    {
        $product = Product::factory()->create();
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();

        $product->categories()->attach([$category1->id, $category2->id]);

        $this->assertCount(2, $product->categories);
    }

    /** @test */
    public function it_can_have_no_categories()
    {
        $product = Product::factory()->create();

        $this->assertCount(0, $product->categories);
    }

    /** @test */
    public function it_validates_on_create_save_and_update()
    {
        $categories = Category::factory()->count(4)->create();

        $invalidProductData = [
            'name' => '',
            'description' => '',
            'price' => -1,
            'categories' => $categories
        ];
        
        $this->expectException(\InvalidArgumentException::class);
        Product::create($invalidProductData);
        
        $this->expectException(\InvalidArgumentException::class);
        $product = Product::factory()->make($invalidProductData);
        $product->save();

        $this->expectException(\InvalidArgumentException::class);
        $product = Product::factory()->create();
        $product->update($invalidProductData);
    }
}
