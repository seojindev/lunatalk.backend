<?php

namespace App\Http\Controllers\Api\Other\v1;

use App\Exceptions\ClientErrorException;
use App\Exceptions\ServiceErrorException;
use App\Http\Controllers\Controller;
use App\Http\Services\OtherServices;
use Illuminate\Support\Facades\Response;

class MediaController extends Controller
{
    /**
     * @var OtherServices
     */
    protected OtherServices $otherServices;

    /**
     * @param OtherServices $otherServices
     */
    public function __construct(OtherServices $otherServices)
    {
        $this->otherServices = $otherServices;
    }

    /**
     * 이미지 등록.
     * @param string $mediaName
     * @param string $mediaCategory
     * @return mixed
     * @throws ClientErrorException
     * @throws ServiceErrorException
     */
    public function createMedia(string $mediaName, string $mediaCategory)
    {
        return Response::success($this->otherServices->createMediaFile($mediaName, $mediaCategory));
    }
}
