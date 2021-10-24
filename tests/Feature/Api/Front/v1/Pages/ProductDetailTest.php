<?php

namespace Tests\Feature\Api\Front\v1\Pages;

use App\Models\ProductMasters;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\BaseCustomTestCase;

class ProductDetailTest extends BaseCustomTestCase
{
    use WithFaker;

    public function setUp(): void {
        parent::setUp();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_front_v1_pages_product_detail_info()
    {

        $this->insertTestProductMaster();


        $pcm = ProductMasters::inRandomOrder()->first();
        $uuid = $pcm->uuid;

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('GET', 'api/front/v1/pages/product/'.$uuid.'/detail')
            ->assertStatus(200)
//            ->dump()
            ->assertJsonStructure([
                'message',
                'result' => [

                ]
            ]);
    }
}
