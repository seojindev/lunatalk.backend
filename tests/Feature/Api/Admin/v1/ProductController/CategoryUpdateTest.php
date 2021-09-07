<?php

namespace Tests\Feature\Api\Admin\v1\ProductController;

use App\Exceptions\ClientErrorException;
use App\Models\ProductCategoryMasters;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\BaseCustomTestCase;

class CategoryUpdateTest extends BaseCustomTestCase
{
    use WithFaker;

    protected string $apiURL;
    protected array $testUser;

    public function setUp(): void
    {
        parent::setUp();

        $this->apiURL = "/api/admin-front/v1/product/:uuid:/update-product-category";
    }

    public function test_admin_front_v1_product_category_update_uuid_없이_요청()
    {
        $this->expectException(NotFoundHttpException::class);

        $testPayload = '{
            "name": "^name^"
        }';

        $testPayload = str_replace('^name^', $this->faker->word(), $testPayload);

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', str_replace(':uuid:', '', $this->apiURL), json_decode($testPayload, true));
    }

    public function test_admin_front_v1_product_category_update_내용_없이_요청()
    {
        $pcm = ProductCategoryMasters::orderBy('id', 'desc')->take(1)->first();

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.update.name.required'));

        $testPayload = '{
            "name": "^name^"
        }';

        $testPayload = str_replace('^name^', '', $testPayload);
        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', str_replace(':uuid:', $pcm->uuid, $this->apiURL), json_decode($testPayload, true));
    }

    public function test_admin_front_v1_product_category_update_정상_요청()
    {
        $pcm = ProductCategoryMasters::orderBy('id', 'desc')->take(1)->first();

        $testPayload = '{
            "name": "^name^"
        }';

        $testPayload = str_replace('^name^', $this->faker->word(), $testPayload);
        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('PUT', str_replace(':uuid:', $pcm->uuid, $this->apiURL), json_decode($testPayload, true));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ProductCategoryMasters::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->artisan('db:seed',['--class' => 'ProductCategoryMastersSeeder']);
    }
}
