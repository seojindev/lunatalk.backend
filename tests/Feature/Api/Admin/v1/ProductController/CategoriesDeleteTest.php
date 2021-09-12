<?php

namespace Tests\Feature\Api\Admin\v1\ProductController;

use App\Exceptions\ClientErrorException;
use App\Models\ProductCategoryMasters;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\BaseCustomTestCase;

class CategoriesDeleteTest extends BaseCustomTestCase
{
    use WithFaker;

    protected string $apiURL;
    protected array $testUser;

    public function setUp(): void
    {
        parent::setUp();

        $this->apiURL = "/api/admin-front/v1/product/delete-product-categories";
    }

    public function test_admin_front_v1_product_categories_delete_uuid_없이_요청()
    {

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('product.admin.category.delete.uuid.required'));

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('DELETE', $this->apiURL);
    }

    public function test_admin_front_v1_product_categories_delete_존재하지_않은_uuid_요청()
    {

        $this->expectException(ModelNotFoundException::class);

        $payload = [
            "uuid" => [
                'fasdfasdfasdfasdf1',
                'fasdfasdfasdfasdf2',
                'fasdfasdfasdfasdf3',
                'fasdfasdfasdfasdf4',
            ]
        ];

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('DELETE', $this->apiURL, $payload);
    }

    public function test_admin_front_v1_product_categories_delete_정상_요청()
    {
        $pcm = ProductCategoryMasters::factory()->count(5)->create();

        $pcms = $pcm->toArray();

        $payload['uuid'] = array_map(function($item) {
            $tmpItem = ProductCategoryMasters::where('id', $item['id'])->first()->toArray();
            return $tmpItem['uuid'];
        }, $pcms);

        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('DELETE', $this->apiURL, $payload);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
        ]);

        foreach ($payload['uuid'] as $uuid) {
            $this->assertSoftDeleted(ProductCategoryMasters::class, [
                'uuid' => $uuid,
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ProductCategoryMasters::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->artisan('db:seed',['--class' => 'ProductCategoryMastersSeeder']);
    }

}
