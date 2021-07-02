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
     * 심플 상품 전체 리스트.
     * @return Builder
     */
    public function simpleTotalProducts() : Builder
    {
        return $this->products::with(['category', 'options.step1', 'options.step2'])->where([['sale', 'Y'], ['active', 'Y']]);
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

    /**
     * 메인 톱 확인 exits.
     * @param Int $product_id
     * @return bool
     */
    public function findHomeMainsMainTopItemExitsByid(Int $product_id) : bool
    {
        return $this->homeMains::where([['gubun', config('extract.homeMainGubun.mainTop.code')], ['product_id', $product_id]])->exists();
    }

    /**
     * 메인 베스트 exits.
     * @param Int $product_id
     * @return bool
     */
    public function findHomeMainsBestItemExitsByid(Int $product_id) : bool
    {
        return $this->homeMains::where([['gubun', config('extract.homeMainGubun.mainBestItem.code')], ['product_id', $product_id]])->exists();
    }

    /**
     * 메인 핫 아이템 exits.
     * @param Int $product_id
     * @return bool
     */
    public function findHomeMainsHotItemExitsByid(Int $product_id) : bool
    {
        return $this->homeMains::where([['gubun', config('extract.homeMainGubun.mainHotItem.code')], ['product_id', $product_id]])->exists();
    }

    /**
     * 홈 TOP 등록.
     * @param array $dataObject
     * @return object
     */
    public function createHomeMain(Array $dataObject) : object
    {
        return $this->homeMains::create($dataObject);
    }

    /**
     * 홈 TOP 삭제.
     * @param String $gubun
     * @param Int $product_id
     * @return bool|mixed|null
     */
    public function deleteHomeMainsItem(String $gubun, Int $product_id)
    {
        return $this->homeMains::where([['gubun', $gubun], ['product_id', $product_id]])->delete();
    }

    /**
     * 홈 TOP 리스트.
     * @return Builder
     */
    public function selectHomeMainTops()
    {
        return $this->homeMains::with(['product', 'media_file'])->where([['gubun', config('extract.homeMainGubun.mainTop.code')],['status', 'Y']]);
    }

    /**
     * 홈 카테고리 랜덤.
     * @param String $category
     * @return object
     */
    public function selectProductCategoryRandomItem(String $category) : object
    {
        return $this->products::with(['category', 'options.step1', 'options.step2', 'rep_images' => function($query) {
            $query->where('media_category', 'G010010');
        }, 'rep_images.mediafile'])
            ->where('category', $category)->inRandomOrder()->firstOrFail();
    }

    /**
     * 홈 베스트 아이템 대표..
     * @return object
     */
    public function selectHomeMainBestItems() : object
    {
        return $this->homeMains::with(['product', 'product.rep_images.mediafile'])->where([['gubun', config('extract.homeMainGubun.mainBestItem.code')],['status', 'Y']]);
    }

    /**
     * 홈 핫 아이템 대표..
     * @return object
     */
    public function selectHomeMainHotItems() : object
    {
        return $this->homeMains::with(['product', 'product.rep_images.mediafile'])->where([['gubun', config('extract.homeMainGubun.mainHotItem.code')],['status', 'Y']]);
    }
}
