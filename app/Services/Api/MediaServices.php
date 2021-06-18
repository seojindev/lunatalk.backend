<?php


namespace App\Services\Api;

use App\Exceptions\ClientErrorException;
use App\Exceptions\ServiceErrorException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Repositories\MediaRepository;

/**
 * Class MediaServices
 * @package App\Services\Api
 */
class MediaServices
{
    /**
     * @var MediaRepository
     */
    protected MediaRepository $mediaRepository;

    /**
     * MediaServices constructor.
     * @param MediaRepository $mediaRepository
     */
    function __construct(MediaRepository $mediaRepository) {
        $this->mediaRepository = $mediaRepository;
    }

    /**
     * media file 업로드 및 생성.
     *
     * @param String $name
     * @param String $category
     * @param Request $request
     * @return array
     * @throws ClientErrorException
     * @throws ServiceErrorException
     */
    public function createMediaFile(String $name, String $category, Request $request) : array
    {
        if ($request->hasFile('media_file')) {

            $validator = Validator::make($request->all(), [
                'media_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ],
                [
                    'media_file.required' => __('message.required.media_file'),
                    'media_file.image' => __('message.other.image_check'),
                    'media_file.mimes' => __('message.other.image_mimes'),
                    'media_file.max' => __('message.other.image_max'),
                ]);

            if( $validator->fails() ) {
                throw new ClientErrorException($validator->errors()->first());
            }

            $origialName = $request->media_file->getClientOriginalName();

            Storage::putFileAs('upload_tmp_images', $request->file('media_file'), $origialName);

            $mediaFile = fopen(storage_path('app/upload_tmp_images' . '/' . $origialName), 'r');

            // 제품 이미지에서 썸네일 옵션 추가.
            $need_thumbnail = 'false';
            if($name == 'products' && $category == 'rep') {
                $need_thumbnail = 'true';
            }

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Client-Token' => env('APP_MEDIA_CLIENT_KEY')
            ])
                ->attach('media_file', $mediaFile)
                ->post(env('APP_MEDIA_URL') . '/media-upload', [
                    'media_name' => $name,
                    'media_category' => $category,
                    'need_thumbnail' => $need_thumbnail
            ]);

            Storage::delete('app/upload_tmp_images' . '/' . $origialName);

            if(!$response->successful()) {
                $result = $response->json();
                throw new ServiceErrorException($result['message']);
            }

            $result = json_decode($response->body())->data;

            $task = $this->mediaRepository->createMediaFile([
                'media_name' => $result->media_name,
                'media_category' => $result->media_category,
                'dest_path' => $result->dest_path,
                'file_name' => $result->new_file_name,
                'original_name' => $result->original_name,
                'file_type' => $result->file_type,
                'file_size' => $result->file_size,
                'file_extension' => $result->file_extension,
            ]);

            return [
                'media_id' => $task->id,
                'media_name' => $result->media_name,
                'media_category' => $result->media_category,
                'media_full_url' => $result->media_full_url,
            ];
        }

        throw new ClientErrorException(__('message.required.media_file'));
    }
}
