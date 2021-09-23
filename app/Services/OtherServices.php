<?php

namespace App\Services;

use App\Exceptions\ClientErrorException;
use App\Exceptions\ServiceErrorException;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Eloquent\MediaFileMastersRepository;

class OtherServices
{
    /**
     * @var Request
     */
    protected Request $currentRequest;

    protected MediaFileMastersRepository $mediaFileMastersRepository;

    /**
     * @param Request $request
     * @param MediaFileMastersRepository $mediaFileMastersRepository
     */
    function __construct(Request $request, MediaFileMastersRepository $mediaFileMastersRepository)
    {
        $this->currentRequest = $request;
        $this->mediaFileMastersRepository = $mediaFileMastersRepository;
    }

    /**
     * @param string $mediaName
     * @param string $mediaCategory
     * @return array
     * @throws ClientErrorException
     * @throws ServiceErrorException
     */
    public function createMediaFile(string $mediaName, string $mediaCategory) : array
    {
        if ($this->currentRequest->hasFile('media_file')) {

            $validator = Validator::make($this->currentRequest->all(), [
                'media_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
            ],
                [
                    'media_file.required' => __('default.media.media_file'),
                    'media_file.image' => __('default.media.image_check'),
                    'media_file.mimes' => __('default.media.image_mimes'),
                    'media_file.max' => __('default.media.image_max'),
                ]);

            if( $validator->fails() ) {
                throw new ClientErrorException($validator->errors()->first());
            }

            $origialName = $this->currentRequest->media_file->getClientOriginalName();

            Storage::putFileAs('upload_tmp_images', $this->currentRequest->file('media_file'), $origialName);

            $mediaFile = fopen(storage_path('app/upload_tmp_images' . '/' . $origialName), 'r');

            // 제품 이미지에서 썸네일 옵션 추가.
            $need_thumbnail = 'false';
            if($mediaName == 'products' && $mediaCategory == 'rep') {
                $need_thumbnail = 'true';
            }

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Client-Token' => env('APP_MEDIA_CLIENT_KEY')
            ])
                ->attach('media_file', $mediaFile)
                ->post(env('APP_MEDIA_URL') . '/media-upload', [
                    'media_name' => $mediaName,
                    'media_category' => $mediaCategory,
                    'need_thumbnail' => $need_thumbnail
                ]);

            Storage::delete('app/upload_tmp_images' . '/' . $origialName);

            Log::debug($response->body());

            if(!$response->successful()) {
                $result = $response->json();
                throw new ServiceErrorException($result['message']);
            }

            $result = json_decode($response->body())->data;

            $task = $this->mediaFileMastersRepository->create([
                'media_name' => $result->media_name,
                'media_category' => $result->media_category,
                'dest_path' => $result->dest_path,
                'file_name' => $result->new_file_name,
                'original_name' => $result->original_name,
                'width' => $result->width,
                'height' => $result->height,
                'file_type' => $result->file_type,
                'file_size' => $result->file_size,
                'file_extension' => $result->file_extension,
            ]);

            return [
                'media_id' => $task->id,
                'media_name' => $result->media_name,
                'media_category' => $result->media_category,
                'file_name' => $result->new_file_name,
                'media_full_url' => $result->media_full_url,
            ];
        }

        throw new ClientErrorException(__('default.media.media_file'));
    }
}
