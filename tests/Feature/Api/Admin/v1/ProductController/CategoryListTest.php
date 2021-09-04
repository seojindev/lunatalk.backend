<?php

namespace Tests\Feature\Api\Admin\v1\ProductController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\BaseCustomTestCase;

class CategoryListTest extends BaseCustomTestCase
{
    use WithFaker;

    protected string $apiURL;

    public function setUp(): void
    {
        parent::setUp();

        $this->apiURL = "/api/admin-front/v1/product/show-product-category";
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
