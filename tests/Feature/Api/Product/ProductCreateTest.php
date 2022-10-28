<?php

namespace Api\Product;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ProductCreateTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_created_product_is_return()
    {
        $category = Category::factory()->create();
        $file = UploadedFile::fake()->image('image.jpg');
        Queue::fake();
        $this->withoutMiddleware();

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
        Passport::actingAs(
            User::factory()->create(['role' => 'admin',]),
            ['api']
        );
        Queue::fake();

        $response = $this->withHeader(
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

        $response->assertCreated();

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

        $customerResponse->assertForbidden();

    }

    public function test_unauthenticated_user_can_not_create_product()
    {
        $response = $this->withHeader(
            'Accept',
            'application/json'
        )->post('api/admin/products');


        $response->assertUnauthorized();

    }
}
