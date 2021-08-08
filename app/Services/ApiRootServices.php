<?php


namespace App\Services;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ClientErrorException;
use App\Repositories\CodesRepository;

/**
 * Class ApiRootServices
 * @package App\Services
 */
class ApiRootServices
{
    /**
     * @var Request
     */
    protected Request $currentRequest;

    /**
     * @var CodesRepository
     */
    protected CodesRepository $serviceRepository;

    /**
     * FrontRootServices constructor.
     * @param Request $request
     * @param CodesRepository $serviceRepository
     */
    function __construct(Request $request, CodesRepository $serviceRepository){
        $this->currentRequest = $request;
        $this->serviceRepository = $serviceRepository;
    }

    /**
     * 서버 공지사항 체크.
     * @return array
     * @throws FileNotFoundException
     */
    public function checkSererNotice() : array
    {
        $noticeFileName = 'server_notice.txt';
        $niticeExists = Storage::disk('inside-temp')->exists($noticeFileName);

        /**
         * 시스템 공지 사항 없을때.
         */
        if($niticeExists == false) {
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
     * 공통 데이터 생성.
     * @return array
     */
    public function createBaseData() : array
    {
        return [
            'codes' => $this->serviceRepository->getCommonCodeList()
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
                'notice_message.required' => __('message.required.notice_message')
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
