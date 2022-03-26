<?php

namespace App\Http\Services;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminSystemServices
{
    /**
     * @var Request
     */
    protected Request $currentRequest;

    /**
     * @param Request $currentRequest
     */
    function __construct(Request $currentRequest) {
        $this->currentRequest = $currentRequest;
    }

    /**
     * 시스템 공지 사항 내용.
     * @return array
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getSystemNotice() : array {
        $noticeFileName = 'server_notice.txt';
        return [
            'notice' => Storage::disk('inside-temp')->get($noticeFileName)
        ];
    }

    /**
     * 시스템 공지사항 추가.
     */
    public function createSystemNotice() : void {
        $noticeFileName = 'server_notice.txt';
        Storage::disk('inside-temp')->put($noticeFileName, $this->currentRequest->input('notice'));
    }
}
