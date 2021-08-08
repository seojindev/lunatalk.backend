<?php

namespace App\Services;

use App\Repositories\CodesRepository;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;

/**
 * Class FrontRootServices
 * @package App\Services
 */
class FrontRootServices
{
    /**
     * @var CodesRepository
     */
    protected CodesRepository $serviceRepository;

    /**
     * FrontRootServices constructor.
     * @param CodesRepository $serviceRepository
     */
    function __construct(CodesRepository $serviceRepository){
        $this->serviceRepository = $serviceRepository;
    }

    /**
     * 공지 사항 내용.
     * @return string
     * @throws FileNotFoundException
     */
    public function getServerNotice(): string
    {
        $noticeFileName = 'server_notice.txt';
        $niticeExists = Storage::disk('inside-temp')->exists($noticeFileName);

        if ($niticeExists) {
            return Storage::disk('inside-temp')->get($noticeFileName);
        }

        return '';
    }
}
