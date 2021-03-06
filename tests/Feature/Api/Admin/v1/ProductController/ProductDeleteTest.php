<?php

namespace Tests\Feature\Api\Admin\v1\ProductController;

use App\Exceptions\ClientErrorException;
use App\Models\ProductImages;
use App\Models\ProductMasters;
use App\Models\ProductOptions;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\BaseCustomTestCase;

class ProductDeleteTest extends BaseCustomTestCase
{
    protected string $apiURL;

    public function setUp(): void
    {
        parent::setUp();

        $this->apiURL = "/api/admin-front/v1/product/:uuid:/delete-product";
    }

    public function test_admin_front_v1_product_delete_uuid_없이_요청()
    {

        $this->expectException(NotFoundHttpException::class);

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('DELETE', str_replace(':uuid:', '', $this->apiURL));
    }

    public function test_admin_front_v1_product_delete_존재하지_않은_uuid_요청()
    {

        $this->expectException(ModelNotFoundException::class);

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('DELETE', str_replace(':uuid:', '123123123asdasd', $this->apiURL));
    }

    public function test_admin_front_v1_product_delete_정상_요청()
    {
        $uuid = ProductMasters::select('uuid')->latest()->first()->uuid;

        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('DELETE', str_replace(':uuid:', $uuid, $this->apiURL));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
        ]);

    }
}
