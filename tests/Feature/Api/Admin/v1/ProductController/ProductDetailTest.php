<?php

namespace Tests\Feature\Api\Admin\v1\ProductController;

use App\Models\ProductImages;
use App\Models\ProductMasters;
use App\Models\ProductOptions;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Tests\BaseCustomTestCase;

class ProductDetailTest extends BaseCustomTestCase
{
    protected string $apiURL;

    public function setUp(): void
    {
        parent::setUp();

        $this->apiURL = "/api/admin-front/v1/product/:uuid:/detail-product";
    }

    public function test_admin_front_v1_product_detail_존재하지_않은_uuid_요청()
    {
        $this->expectException(ModelNotFoundException::class);

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('GET', str_replace(':uuid:', 'asdasdasdasdasdasd', $this->apiURL));
    }

    public function test_admin_front_v1_product_detail_정상_요청()
    {
        $productData = $this->insertTestProductMaster();
        $uuid = ProductMasters::select('uuid')->where('id', $productData->id)->first()->uuid;

        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('GET', str_replace(':uuid:', $uuid, $this->apiURL));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'result' =>  [
                'uuid',
                'category' => [
                    'uuid',
                    'name'
                ],
                'name',
                "barcode",
                "price" => [
                    'number',
                    'string'
                ],
                "stock" => [
                    'number',
                    'string'
                ],
                "memo",
                "sale",
                "active",
                "options" => [
                    '*' => [
                        "color",
                        "wireless",
                    ]
                ],
            ]
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ProductImages::truncate();
        ProductOptions::truncate();
        ProductMasters::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}