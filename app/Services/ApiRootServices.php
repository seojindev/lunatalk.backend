<?php


namespace App\Services;
use App\Repositories\ServiceRepository;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;

/**
 * Class ApiRootServices
 * @package App\Services
 */
class ApiRootServices
{
    /**
     * @var ServiceRepository
     */
    protected ServiceRepository $serviceRepository;

    /**
     * FrontRootServices constructor.
     * @param ServiceRepository $serviceRepository
     */
    function __construct( ServiceRepository $serviceRepository){
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
}
