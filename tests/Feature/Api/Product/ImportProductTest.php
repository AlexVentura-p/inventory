<?php

namespace Tests\Feature\Api\Product;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ImportProductTest extends TestCase
{
    use DatabaseTransactions;

    public function test_guest_cannot_access_import_product_endpoint()
    {
        $response = $this->postJson('api/admin/products/import');

        $response->assertUnauthorized();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @dataProvider  rolesData
     */
    public function test_import_product_endpoint_access_for_authenticated_users($role, $result)
    {
        Passport::actingAs(
            User::factory()->create([
                'role' => $role
            ])
        );
        $file = new UploadedFile(
            base_path('storage/Test/JsonFilesTest/products.json'),
            'products.json'
        );

        $response = $this->post('api/admin/products/import', [
            'products' => $file
        ]);

        $response->assertStatus($result);
    }

    public function rolesData(): array
    {
        return [
            ['admin', 200],
            ['customer', 403]
        ];
    }


    public function test_import_endpoint_can_parse_json()
    {
        $file = new UploadedFile(
            base_path('storage/Test/JsonFilesTest/products.json'),
            'products.json'
        );

        $this->withoutMiddleware();


        $response = $this->withHeaders([
            'Content-Type' => 'multipart/form-data',
            'Accept' => 'application/json'
        ])
            ->post('api/admin/products/import', [
                'products' => $file
            ]);

        $products = Product::all()->toArray();

        $response->assertExactJson($products);
    }

    public function test_import_endpoint_can_parse_csv()
    {
        $file = new UploadedFile(
            base_path('storage/Test/CsvFilesTest/products.csv'),
            'products.csv'
        );

        $this->withoutMiddleware();

        $response = $this->withHeader('Content-Type', 'multipart/form-data')
            ->post('api/admin/products/import', [
                'products' => $file
            ]);

        $products = Product::all()->toArray();

        $response->assertExactJson($products);
    }

}
