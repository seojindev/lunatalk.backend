<?php

namespace Tests\Feature\Api\Front\v1\Pages;

use App\Models\MediaFileMasters;
use App\Models\ProductCategoryMasters;
use App\Models\ProductMasters;
use App\Models\ProductOptions;
use Database\Factories\ProductOptionsFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\BaseCustomTestCase;

class ProductCategoryListTest extends BaseCustomTestCase
{
    use WithFaker;

    protected string $apiURL;
    protected array $testUser;

    public function setUp(): void {
        parent::setUp();

    }

    public function test_front_v1_pages_product_category_list()
    {

        $this->insertTestProductMaster();
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();
        $this->insertTestProductMaster();


        $pcm = ProductCategoryMasters::inRandomOrder()->first();

        $uuid = $pcm->uuid;

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('GET', '/api/front/v1/pages/product-category/'.$uuid.'/list')
            ->assertStatus(200)
//            ->dump()
            ->assertJsonStructure([
                'message',
                'result' => [

                ]
            ]);
    }
}
