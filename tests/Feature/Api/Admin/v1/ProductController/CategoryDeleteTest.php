<?php

namespace Tests\Feature\Api\Admin\v1\ProductController;

use App\Models\ProductCategoryMasters;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\BaseCustomTestCase;

class CategoryDeleteTest extends BaseCustomTestCase
{
    use WithFaker;

    protected string $apiURL;
    protected array $testUser;

    public function setUp(): void
    {
        parent::setUp();

        $this->apiURL = "/api/admin-front/v1/product/:uuid:/delete-product-category";
    }

    public function test_admin_front_v1_product_category_delete_uuid_없이_요청()
    {

        $this->expectException(NotFoundHttpException::class);

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('DELETE', str_replace(':uuid:', '', $this->apiURL));
    }

    public function test_admin_front_v1_product_category_delete_존재하지_않은_uuid_요청()
    {

        $this->expectException(ModelNotFoundException::class);

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('DELETE', str_replace(':uuid:', '123123123asdasd', $this->apiURL));
    }

    public function test_admin_front_v1_product_category_delete_정상_요청()
    {
        $pcm = ProductCategoryMasters::factory()->create([
            'uuid' => Str::uuid()
        ]);

        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('DELETE', str_replace(':uuid:', $pcm->uuid, $this->apiURL));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
        ]);
    }
}
