<?php

namespace Tests\Feature\Api\Admin\v1\ProductController;

use App\Exceptions\ClientErrorException;
use App\Models\ProductCategoryMasters;
use App\Models\ProductMasters;
use Database\Seeders\ProductCategoryMastersSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\BaseCustomTestCase;

class CategoryCreateTest extends BaseCustomTestCase
{
    use WithFaker;

    protected string $apiURL;

    public function setUp(): void
    {
        parent::setUp();

        $this->apiURL = "/api/admin-front/v1/product/create-product-category";
    }

    public function test_admin_front_v1_product_category_create_제목_없이_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.create.name.required'));

        $testPayload = <<<EOF
        {
                "name": ""
        }
EOF;

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->apiURL, json_decode($testPayload, true));
    }

    public function test_admin_front_v1_product_category_create_중복_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.create.name.unique'));

        $testPayload = '{
            "name": "acc"
        }';

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->apiURL, json_decode($testPayload, true));
    }

    public function test_admin_front_v1_product_category_create_정상_요청()
    {
        $testPayload = '{
            "name": "^name^"
        }';

        $testPayload = str_replace('^name^', $this->faker->word(), $testPayload);

        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->apiURL, json_decode($testPayload, true));
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'message',
            'result' => [
                'uuid',
            ]
        ]);
        $res_array = (array)json_decode($response->content());
        ProductCategoryMasters::where('uuid', $res_array["result"]->uuid)->forceDelete();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ProductCategoryMasters::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->artisan('db:seed',['--class' => 'ProductCategoryMastersSeeder']);


    }
}
