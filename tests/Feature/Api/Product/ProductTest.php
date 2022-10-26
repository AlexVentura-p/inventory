<?php

namespace Api\Product;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
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
        Product::factory(3)->create([
            'is_visible' => 1,
        ]);

        Product::factory()->create([
            'title' => 'NoVisibleProduct',
            'is_visible' => 0,
        ]);

        $response = $this->getJson('/api/products');

        $response->assertJsonMissing(['title' => 'NoVisibleProduct']);
    }



    public function test_admin_can_not_request_only_visible_products_endpoint()
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
            ]);
    }

    public function test_admin_can_create_product()
    {
        $category = Category::factory()->create();
        $file = UploadedFile::fake()->image('image.jpg');
        $admin = Passport::actingAs(
            User::factory()->create(['role' => 'admin',]),
            ['api']
        );

        $response = $this->actingAs($admin)->withHeader(
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

        $response->assertStatus(201);

    }

    public function test_customer_can_not_create_product()
    {
        $customer = Passport::actingAs(
            User::factory()->create(['role' => 'customer',]),
            ['api']
        );

        $customerResponse = $this->actingAs($customer)->withHeader(
            'Accept',
            'application/json'
        )->post('api/admin/products');


        $customerResponse->assertStatus(403);

    }

    public function test_unauthenticated_user_can_not_create_product()
    {
        $response = $this->withHeader(
            'Accept',
            'application/json'
        )->post('api/admin/products');


        $response->assertStatus(401);

    }



}
