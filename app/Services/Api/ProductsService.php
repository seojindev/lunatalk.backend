<?php


namespace App\Services\Api;

use App\Exceptions\ClientErrorException;
use Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Repositories\ProductsRepository;

/**
 * Class ProductsService
 * @package App\Services\Api
 */
class ProductsService
{
    /**
     * @var ProductsRepository
     */
    protected ProductsRepository $productsRepository;

    /**
     * ProductsService constructor.
     * @param ProductsRepository $productsRepository
     */
    public function __construct(ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    /**
     * 상품 등록 수정 벨리데이션 처리.
     * @param Request $request
     * @return bool
     * @throws ClientErrorException
     */
    static function productValidation(Request $request) : bool
    {
        $validator = Validator::make($request->all(), [
            'product_category' => 'required|exists:codes,code_id',
            'product_name' => 'required|string|min:1',
            'product_option_step1' => 'required|exists:codes,code_id',
            'product_option_step2' => 'nullable|exists:codes,code_id',
            'product_price' => 'required|numeric',
            'product_stock' => 'required|numeric',
//            'product_barcode' => 'nullable|string',
            'product_sale' => 'required|in:Y,N',
            'product_active' => 'required|in:Y,N|max:1',
            'product_image' => 'required',
            'product_image.*' => 'integer|exists:media_files,id',
            'product_detail_image' => 'required',
            'product_detail_image.*' => 'integer|numeric|exists:media_files,id',
        ],
            [
                'product_category.required'=> __('message.product.create.category.required'),
                'product_category.exists'=> __('message.product.create.category.exists'),
                'product_name.required'=> __('message.product.create.name.required'),
                'product_option_step1.required'=> __('message.product.create.option_step1.required'),
                'product_option_step1.exists'=> __('message.product.create.option_step1.exists'),
                'product_option_step2.exists'=> __('message.product.create.option_step2.exists'),
                'product_price.required'=> __('message.product.create.price.required'),
                'product_price.numeric'=> __('message.product.create.price.numeric'),
                'product_stock.required'=> __('message.product.create.stock.required'),
                'product_stock.numeric'=> __('message.product.create.stock.numeric'),
//            'product_barcode.required'=> __('message.product.create.tags_required'),
                'product_sale.required'=> __('message.product.create.sale.required'),
                'product_sale.in'=> __('message.product.create.sale.in'),
                'product_active.required'=> __('message.product.create.active.required'),
                'product_active.in'=> __('message.product.create.active.in'),
                'product_image.required'=> __('message.product.create.image.required'),
                'product_image.numeric'=> __('message.product.create.image.numeric'),
                'product_image.*.exists'=> __('message.product.create.image.exists'),
                'product_detail_image.required'=> __('message.product.create.detail.required'),
                'product_detail_image.numeric'=> __('message.product.create.detail.numeric'),
                'product_detail_image.*.exists'=> __('message.product.create.detail.exists'),
            ]);

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }

        return true;
    }

    /**
     * 삼풍 등록 처리.
     * @param Request $request
     * @throws ClientErrorException
     */
    public function productCreate(Request $request) : void
    {
        self::productValidation($request);

        $createTask = $this->productsRepository->createProduct([
            'uuid' => Helper::randomNumberUUID(),
            'category' => $request->input('product_category'),
            'name' => $request->input('product_name'),
            'barcode' => $request->input('product_barcode'),
            'price' => $request->input('product_price'),
            'stock' => $request->input('product_stock'),
            'memo' => $request->input('product_memo'),
            'sale' => $request->input('product_sale'),
            'active' => $request->input('product_active')
        ]);

        $this->productsRepository->createProductOption([
            'product_id' => $createTask->id,
            'step1' => $request->input('product_option_step1'),
            'step2' => $request->input('product_option_step2')
        ]);

        // insert 가 시간은 뺴멱고 등록 처리 해서 create 로 변경.
        foreach ($request->input('product_image') as $element) :
            $this->productsRepository->createProductImage([
                'product_id' => $createTask->id,
                'media_category' => "G010010",
                'media_id' => $element,
            ]);
        endforeach;

        foreach ($request->input('product_detail_image') as $element) :
            $this->productsRepository->createProductImage([
                'product_id' => $createTask->id,
                'media_category' => "G010020",
                'media_id' => $element,
            ]);
        endforeach;
    }

    /**
     * 상춤 업데이트 처리.
     * @param Request $request
     * @param String $uuid
     * @throws ClientErrorException
     */
    public function productUpdate(Request $request, String $uuid) : void
    {
        $productInfo = $this->productsRepository->productExitsByUUID($uuid);

        if(!$productInfo) {
            throw new ModelNotFoundException();
        }

        self::productValidation($request);

        $this->productsRepository->updateProduct($productInfo->id, [
            'category' => $request->input('product_category'),
            'name' => $request->input('product_name'),
            'barcode' => $request->input('product_barcode'),
            'price' => $request->input('product_price'),
            'stock' => $request->input('product_stock'),
            'memo' => $request->input('product_memo'),
            'sale' => $request->input('product_sale'),
            'active' => $request->input('product_active')
        ]);

        // 옵션 삭제 후 다시 등록.
        $this->productsRepository->deleteProductOptins($productInfo->id);
        $this->productsRepository->createProductOption([
            'product_id' => $productInfo->id,
            'step1' => $request->input('product_option_step1'),
            'step2' => $request->input('product_option_step2'),
        ]);

        // 업데이트시 일단 이미지를 삭제후 등록.
        $this->productsRepository->deleteProdctImages($productInfo->id);
        foreach ($request->input('product_image') as $element) :
            $this->productsRepository->createProductImage([
                'product_id' => $productInfo->id,
                'media_category' => "G010010",
                'media_id' => $element,
            ]);
        endforeach;

        foreach ($request->input('product_detail_image') as $element) :
            $this->productsRepository->createProductImage([
                'product_id' => $productInfo->id,
                'media_category' => "G010020",
                'media_id' => $element,
            ]);
        endforeach;
    }

    public function tabMainTopItems() : array
    {
        return [];
    }

    public function tabMainProductsCategoryItems() : array
    {
        return [];
    }

    public function tabMainProductsBestItems() : array
    {
        return [];
    }

    public function tabMainProductsHotItems() : array
    {
        return [];
    }
}
