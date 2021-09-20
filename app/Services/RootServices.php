<?php


namespace App\Services;
use App\Models\ProductCategoryMasters;
use App\Repositories\Eloquent\ProductCategoryMastersRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ClientErrorException;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use App\Repositories\Eloquent\ProductColorOptionMastersRepository;
use App\Repositories\Eloquent\ProductWirelessOptionMastersRepository;
use App\Repositories\Eloquent\CodesRepository;
use App\Repositories\Eloquent\ProductMastersRepository;

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
     * @param Request $request
     * @param CodesRepository $codesRepository
     * @param ProductCategoryMastersRepository $productCategoryMastersRepository
     * @param ProductMastersRepository $productMastersRepository
     * @param ProductColorOptionMastersRepository $productColorOptionMastersRepository
     * @param ProductWirelessOptionMastersRepository $productWirelessOptionMastersRepository
     */
    function __construct(
        Request $request,
        CodesRepository $codesRepository,
        ProductCategoryMastersRepository $productCategoryMastersRepository,
        ProductMastersRepository $productMastersRepository,
        ProductColorOptionMastersRepository $productColorOptionMastersRepository,
        ProductWirelessOptionMastersRepository $productWirelessOptionMastersRepository
    ){
        $this->currentRequest = $request;
        $this->codesRepository = $codesRepository;
        $this->productCategoryMastersRepository = $productCategoryMastersRepository;
        $this->productMastersRepository = $productMastersRepository;
        $this->productColorOptionMastersRepository = $productColorOptionMastersRepository;
        $this->productWirelessOptionMastersRepository = $productWirelessOptionMastersRepository;

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
                    }, $item['color']),
                    'wireless' => array_map(function($item) {
                        return [
                            'id' => $item['wireless']['id'],
                            'wireless' => $item['wireless']['wireless']
                        ];
                    } , $item['wireless'])
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
        ];
    }

    /**
     * 공통 데이터 생성.
     * @return array
     */
    public function createBaseData() : array {
        return [
            'codes' => $this->getCommonCodeList(),
            'products' => $this->getProducts()
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
