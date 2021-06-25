<?php

namespace App\Services;

use App\Repositories\ServiceRepository;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;

/**
 * Class FrontRootServices
 * @package App\Services
 */
class FrontRootServices
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
