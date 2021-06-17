<?php

namespace App\Http\Controllers\Api\v1\Other;

use App\Exceptions\ClientErrorException;
use App\Exceptions\ServiceErrorException;
use App\Http\Controllers\Api\RootController;
use Illuminate\Http\Request;
use App\Services\Api\MediaServices;
use Illuminate\Support\Facades\Response;

/**
 * Class MediaController
 * @package App\Http\Controllers\Api\v1\Other
 */
class MediaController extends RootController
{
    /**
     * @var MediaServices
     */
    protected MediaServices $mediaServices;

    /**
     * MediaController constructor.
     * @param MediaServices $mediaServices
     */
    public function __construct(MediaServices $mediaServices)
    {
        $this->mediaServices = $mediaServices;
    }

    /**
     * @param String $mediaName
     * @param String $mediaCategory
     * @param Request $request
     * @return mixed
     * @throws ClientErrorException
     * @throws ServiceErrorException
     */
    public function media_create(String $mediaName, String $mediaCategory, Request $request)
    {
        $task = $this->mediaServices->createMediaFile($mediaName, $mediaCategory, $request);

        return Response::message_success(__('message.response.process_success'), $task);
    }
}
