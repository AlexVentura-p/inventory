<?php

namespace Api\Product;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_only_visible_products()
    {
        Product::factory(2)->create([
            'is_visible' => 1,
        ]);

        Product::factory(1)->create([
            'is_visible' => 0,
        ]);

        $response = $this->getJson('/api/products');

        $response->assertJsonCount(2, 'data');
    }

    public function test_admin_can_not_request_only_visible_endpoint()
    {
        Passport::actingAs(
            User::factory()->create(['role' => 'admin',]),
            ['api']
        );

        $response = $this->getJson('/api/products');

        $response->assertStatus(403);
    }

    public function test_created_product_is_return()
    {
        $category = Category::factory()->create();
        $file = UploadedFile::fake()->image('image.jpg');
        Passport::actingAs(
            User::factory()->create(['role' => 'admin',]),
            ['api']
        );


        $response = $this->withHeader(
            'Accept',
            'application/json'
        )->post('api/admin/products', [
            'title' => 'testProduct',
            'description' => 'my product description',
            'type' => 'DigitalProduct',
            'is_visible' => 1,
            'unit_price' => 100,
            'image' => $file,
            'category_id' => $category->id
        ]);


        $response
            ->assertJson([
                "title" => "testProduct",
                "description" => "my product description",
                "unit_price" => 100,
                "type" => "DigitalProduct",
                "is_visible" => 1,
                "image" => "products/testProduct.jpg",
                "id" => 1,
            ]);
    }

    public function test_only_admin_can_create_product()
    {
        $category = Category::factory()->create();
        $file = UploadedFile::fake()->image('image.jpg');

        $customer = Passport::actingAs(
            User::factory()->create(['role' => 'customer',]),
            ['api']
        );

        $admin = Passport::actingAs(
            User::factory()->create(['role' => 'admin',]),
            ['api']
        );


        $customerResponse = $this->actingAs($customer)->withHeader(
            'Accept',
            'application/json'
        )->post('api/admin/products');

        $adminResponse = $this->actingAs($customer)->withHeader(
            'Accept',
            'application/json'
        )->post('api/admin/products',[
            'title' => 'testProduct',
            'description' => 'my product description',
            'type' => 'DigitalProduct',
            'is_visible' => 1,
            'unit_price' => 100,
            'image' => $file,
            'category_id' => $category->id
        ]);


        $customerResponse->assertStatus(403);
        $adminResponse->assertStatus(201);

    }



}
