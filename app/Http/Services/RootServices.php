<?php


namespace App\Http\Services;
use App\Http\Repositories\Eloquent\ProductBadgeMastersRepository;
use App\Http\Repositories\Eloquent\ProductCategoryMastersRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ClientErrorException;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use App\Http\Repositories\Eloquent\ProductColorOptionMastersRepository;
use App\Http\Repositories\Eloquent\ProductWirelessOptionMastersRepository;
use App\Http\Repositories\Eloquent\CodesRepository;
use App\Http\Repositories\Eloquent\ProductMastersRepository;

/**
 * Class ApiRootServices
 * @package App\Services
 */
class RootServices
{
    /**
     * @var Request
     */
    protected Request $currentRequest;

    /**
     * @var CodesRepository
     */
    protected CodesRepository $codesRepository;

    /**
     * @var ProductMastersRepository
     */
    protected ProductMastersRepository $productMastersRepository;

    /**
     * @var ProductColorOptionMastersRepository
     */
    protected ProductColorOptionMastersRepository $productColorOptionMastersRepository;

    /**
     * @var ProductWirelessOptionMastersRepository
     */
    protected ProductWirelessOptionMastersRepository $productWirelessOptionMastersRepository;

    /**
     * @var ProductCategoryMastersRepository
     */
    protected ProductCategoryMastersRepository $productCategoryMastersRepository;

    /**
     * @var ProductBadgeMastersRepository
     */
    protected ProductBadgeMastersRepository $productBadgeMastersRepository;

    /**
     * @param Request $request
     * @param CodesRepository $codesRepository
     * @param ProductCategoryMastersRepository $productCategoryMastersRepository
     * @param ProductMastersRepository $productMastersRepository
     * @param ProductColorOptionMastersRepository $productColorOptionMastersRepository
     * @param ProductWirelessOptionMastersRepository $productWirelessOptionMastersRepository
     * @param ProductBadgeMastersRepository $productBadgeMastersRepository
     */
    function __construct(
        Request $request,
        CodesRepository $codesRepository,
        ProductCategoryMastersRepository $productCategoryMastersRepository,
        ProductMastersRepository $productMastersRepository,
        ProductColorOptionMastersRepository $productColorOptionMastersRepository,
        ProductWirelessOptionMastersRepository $productWirelessOptionMastersRepository,
        ProductBadgeMastersRepository $productBadgeMastersRepository

    ){
        $this->currentRequest = $request;
        $this->codesRepository = $codesRepository;
        $this->productCategoryMastersRepository = $productCategoryMastersRepository;
        $this->productMastersRepository = $productMastersRepository;
        $this->productColorOptionMastersRepository = $productColorOptionMastersRepository;
        $this->productWirelessOptionMastersRepository = $productWirelessOptionMastersRepository;
        $this->productBadgeMastersRepository = $productBadgeMastersRepository;

    }

    /**
     * 서버 공지사항 체크.
     * @return array
     * @throws FileNotFoundException
     */
    public function checkSererNotice() : array
    {
        $noticeFileName = 'server_notice.txt';
        $noticeExists = Storage::disk('inside-temp')->exists($noticeFileName);

        /**
         * 시스템 공지 사항 없을때.
         */
        if($noticeExists == false) {
            return [
                'check' => false,
                'notice' => ''
            ];
        }

        /**
         * 시스템 공지 사항 있을때.
         */
        $noticeContents = Storage::disk('inside-temp')->get($noticeFileName);
        if ($noticeContents) {
            return [
                'check' => true,
                'notice' => $noticeContents
            ];
        }

        return [
            'check' => false,
            'notice' => ''
        ];
    }

    /**
     * 공통 코드 리스트.
     * @return array[]
     */
    public function getCommonCodeList(): array
    {
        $codesLists = $this->codesRepository->defaultall()->toArray();

        $code_group = array();
        $code_name = array();

        foreach (array_filter($codesLists, function($e) {
            return $e['code_id'];
        }) as $item) :
            $code_group[$item['group_id']][] = [
                'code_id' => $item['code_id'],
                'code_name' => $item['code_name'],
            ];

            $code_name[$item['code_id']] = $item['code_name'];
        endforeach;

        return [
            'code_name' => $code_name,
            'code_group' => $code_group
        ];
    }

    /**
     * 상품 리스트 생성 함수.
     * @return array
     */
    public function getProducts() : array {


        return [
            'category' => array_map(function($item) {
                return [
                    'id' => $item['id'],
                    'uuid' => $item['uuid'],
                    'name' => $item['name']
                ];
            }, $this->productCategoryMastersRepository->getActiveAll()->toArray()),
            'list' => array_map(function ($item) {

                return [
                    'id' => $item['id'],
                    'uuid' => $item['uuid'],
                    'name' => $item['name'],
                    'quantity' => [
                        'number' => $item['quantity'],
                        'string' => number_format($item['quantity']),
                    ],
                    'original_price' => [
                        'number' => $item['original_price'],
                        'string' => number_format($item['original_price']),
                    ],
                    'price' => [
                        'number' => $item['price'],
                        'string' => number_format($item['price']),
                    ],
                    'category' => $item['category'],
                    'color' => array_map(function($item) {
                        return [
                            'id' => $item['color']['id'],
                            'name' => $item['color']['name']
                        ];
                    }, $item['colors']),
//                    'wireless' => array_map(function($item) {
//                        return [
//                            'id' => $item['wireless']['id'],
//                            'wireless' => $item['wireless']['wireless']
//                        ];
//                    } , $item['wireless']),
                    'wireless' => $item['wireless'] ? [
                        'id' => $item['wireless']['wireless']['id'],
                        'wireless' => $item['wireless']['wireless']['wireless'],
                    ] : null,
                    'badge' => array_map(function($item) {
                        return [
                            'id' => $item['badge']['id'],
                            'name' => $item['badge']['name'],
                            'image' => [
                                'id' => $item['badge']['image']['id'],
                                'file_name' => $item['badge']['image']['file_name'],
                                'url' => env('APP_MEDIA_URL') . $item['badge']['image']['dest_path'] . '/' . $item['badge']['image']['file_name']
                            ],
                        ];
                    }, $item['badge']),
                    'best_item' => !empty($item['best_item']),
                    'new_item' => !empty($item['new_item'])
                ];
            }, $this->productMastersRepository->getAdminProductMasters()->toArray()),
            'color_options' => array_map(function($item) {
                return [
                    "id" => $item['id'],
                    "name" => $item['name'],
                    "eng_name" => $item['eng_name'],
                ];
            }, $this->productColorOptionMastersRepository->getActiveAll()->toArray()),
            'wireless_options' => array_map(function($item) {
                return [
                    'id' => $item['id'],
                    'wireless' => $item['wireless'],
                ];
            }, $this->productWirelessOptionMastersRepository->getActiveAll()->toArray()),
            'badge' => array_map(function($item) {
                return [
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'image' => [
                        'id' => $item['image']['id'],
                        'file_name' => $item['image']['file_name'],
                        'url' => env('APP_MEDIA_URL') . $item['image']['dest_path'] . '/' . $item['image']['file_name']
                    ],
                ];
            } , $this->productBadgeMastersRepository->getDefaultList()->toArray())
        ];
    }

    /**
     * 공통 상품 카테고리.
     * @return array
     */
    public function getProductCategory() : array {
        return array_map(function($item) {
            return [
                'uuid' => $item['uuid'],
                'name' => $item['name'],
            ];
        } , $this->productCategoryMastersRepository->defaultAll()->toArray());
    }

    /**
     * 공통 데이터 생성.
     * @return array
     */
    public function createBaseData() : array {

        if($this->currentRequest->header('request-client-type') === '0100040') {
            return [
                'codes' => $this->getCommonCodeList(),
                'product_category' => $this->getProductCategory(),
                'products' => $this->getProducts(),
            ];
        }

        return [
            'codes' => $this->getCommonCodeList(),
            'product_category' => $this->getProductCategory(),
        ];
    }

    /**
     * 서비스 공지사항 추가 수정.
     * @throws ClientErrorException
     */
    public function createServiceNotice() : void
    {
        $validator = Validator::make($this->currentRequest->all(), [
            'notice_message' => 'required',
        ],
            [
                'notice_message.required' => __('required.notice_message')
            ]);

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }

        Storage::disk('inside-temp')->put('server_notice.txt', $this->currentRequest->input('notice_message'));
    }

    /**
     * 서비스 공지사항 삭제 처리.
     */
    public function deleteServiceNotice() : void
    {
        Storage::disk('inside-temp')->delete('server_notice.txt');
    }
}
