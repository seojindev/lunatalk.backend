<?php


namespace App\Repositories;

use App\Models\Products;
use App\Models\ProductImages;
use App\Models\ProductOptions;
use Illuminate\Database\Eloquent\Builder;

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
     * 상품 존재 여부 체크.
     * @param String $uuid
     * @return object
     */
    public function productExitsByUUID(String $uuid) : object
    {
        return $this->products::where('uuid', $uuid)->firstOrFail();
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
     * 상품 내용 업데이트.
     * @param Int $product_id
     * @param array $dataObject
     * @return bool
     */
    public function updateProduct(Int $product_id, Array $dataObject) : bool
    {
        return $this->products::where('id', $product_id)->update($dataObject);
    }

    /**
     * 상품 이미지 등록 (create)
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

    /**
     * 상품 전제 리스트.
     * @return Builder
     */
    public function totalProductsForList(): Builder
    {
        return $this->products::with(['category', 'options.step1', 'options.step2', 'images' => function($query) {
            $query->where('media_category', 'G010010');
        }, 'images.category', 'images.mediafile']);

    }

    /**
     * 상품 상세 정보.
     * @param String $uuid
     * @return object
     */
    public function detailProduct(String $uuid) : object
    {
        return $this->products::with(['category', 'options.step1', 'options.step2', 'images' , 'images.category', 'images.mediafile'])
            ->where('uuid', $uuid)->firstOrFail();
    }

    /**
     * 옵션 테이블 내용 삭제.
     * @param Int $product_id
     * @return bool
     */
    public function deleteProductOptins(Int $product_id) : bool
    {
        return $this->productOptions::where('product_id', $product_id)->delete();
    }

    /**
     * 상품 이미지 삭제.
     * @param Int $product_id
     * @return bool
     */
    public function deleteProdctImages(Int $product_id) : bool
    {
        return $this->productImages::where('product_id', $product_id)->delete();
    }

    /**
     * uuid 로 상품 검색.
     * @param string $uuid
     * @return object
     */
    public function findProductByUUID(string $uuid) : object
    {
        return $this->products::where('uuid', $uuid)->firstOrFail();
    }

}
