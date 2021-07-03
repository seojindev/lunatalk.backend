<?php


namespace App\Services\Api;
use App\Exceptions\ClientErrorException;
use App\Repositories\ServiceRepository;
use Illuminate\Http\Request;

class OtherServices
{

    protected Request $currentRequest;

    protected ServiceRepository $serviceRepository;

    function __construct(Request $currentRequest, ServiceRepository $serviceRepository)
    {
        $this->currentRequest = $currentRequest;
        $this->serviceRepository = $serviceRepository;
    }

    /**
     * @throws ClientErrorException
     */
    public function createHomeTabClick(String $click_code) : void
    {
        $tempArrayProductCategory = array_values(array_map(function($item) {
            return $item['code'];
        }, config('extract.productCategory')));

        // 상품 카테고리 일때.
        if(in_array($click_code, $tempArrayProductCategory)) {
            $this->serviceRepository->createHomeTabClick([
                'category_code' => $click_code,
                'remote_addr' => $this->currentRequest->ip(),
                'header' => json_encode($this->currentRequest->header())
            ]);

            return;
        }

        // 홈페인 편집 코드 일때.
        if($this->serviceRepository->existsHomeMainsUid($click_code)) {
            $this->serviceRepository->createHomeTabClick([
                'home_main_uid' => $click_code,
                'remote_addr' => $this->currentRequest->ip(),
                'header' => json_encode($this->currentRequest->header())
            ]);

            return;
        }

        throw new ClientErrorException(__('message.other.code_exits'));
    }
}
