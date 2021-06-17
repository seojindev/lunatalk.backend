<?php


namespace App\Repositories;

use App\Models\Products;
use App\Models\ProductImages;
use App\Models\ProductOptions;

/**
 * Class ProductsRepository
 * @package App\Repositories
 */
class ProductsRepository implements ProductsRepositoryInterface
{
    /**
     * @var Products
     */
    protected Products $products;

    /**
     * @var ProductImages
     */
    protected ProductImages $productImages;

    /**
     * @var ProductOptions
     */
    protected ProductOptions $productOptions;

    /**
     * ProductsRepository constructor.
     * @param Products $products
     * @param ProductOptions $productOptions
     * @param ProductImages $productImages
     */
    public function __construct(Products $products, ProductOptions $productOptions, ProductImages $productImages)
    {
        $this->products = $products;
        $this->productImages = $productImages;
        $this->productOptions = $productOptions;
    }

    /**
     * 상품 데이터 등록
     * @param array $dataObject
     * @return object
     */
    public function createProduct(Array $dataObject) : object
    {
        return $this->products::create($dataObject);
    }

    /**
     * 상품 이미지 등록
     * @param array $dataObject
     * @return object
     */
    public function createProductImage(Array $dataObject) : object
    {
        return $this->productImages::create($dataObject);
    }

    /**
     * 상품 옵션
     * @param array $dataObject
     * @return object
     */
    public function createProductOption(Array $dataObject) : object
    {
        return $this->productOptions::create($dataObject);
    }

}
