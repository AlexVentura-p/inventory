<?php

namespace Api\Product;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ProductListTest extends TestCase
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

        $response->assertForbidden();
    }





}
