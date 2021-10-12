<?php

namespace App\Http\Services;

use App\Exceptions\ClientErrorException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Http\Repositories\Eloquent\NoticeMastersRepository;
use App\Http\Repositories\Eloquent\NoticeImagesRepository;

class AdminSiteManageServices
{
    /**
     * @var Request
     */
    protected Request $currentRequest;

    /**
     * @var NoticeMastersRepository
     */
    protected NoticeMastersRepository $noticeMastersRepository;

    /**
     * @var NoticeImagesRepository
     */
    protected NoticeImagesRepository $noticeImagesRepository;

    /**
     * @param Request $currentRequest
     * @param NoticeMastersRepository $noticeMastersRepository
     * @param NoticeImagesRepository $noticeImagesRepository
     */
    function __construct(Request $currentRequest, NoticeMastersRepository $noticeMastersRepository, NoticeImagesRepository $noticeImagesRepository)
    {
        $this->currentRequest = $currentRequest;
        $this->noticeMastersRepository = $noticeMastersRepository;
        $this->noticeImagesRepository = $noticeImagesRepository;
    }

    /**
     * @return array
     * @throws ClientErrorException
     */
    public function noticeCreate() : array {

        $validator = Validator::make($this->currentRequest->all(), [
            'category' => 'required|exists:codes,code_id',
            'title' => 'required',
            'content' => 'required',
            'active' => 'required|in:Y,N|max:1',
            'image.*' => 'integer|exists:media_file_masters,id',
        ],
            [
                'category.required' => __('admin-site-manage.notice.category.required'),
                'category.exists' => __('admin-site-manage.notice.category.exists'),
                'title.required' => __('admin-site-manage.notice.title.required'),
                'content.required' => __('admin-site-manage.notice.content.required'),
                'active.required'=> __('admin-site-manage.notice.active.required'),
                'active.in'=> __('admin-site-manage.notice.active.in'),
                'image.*.integer' => __('admin-site-manage.notice.image.integer'),
                'image.*.exists' => __('admin-site-manage.notice.image.exists')
            ]);

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }

        $noticeTask = $this->noticeMastersRepository->create([
            'category' => $this->currentRequest->input('category'),
            'title' => $this->currentRequest->input('title'),
            'content' => $this->currentRequest->input('content'),
            'active' => $this->currentRequest->input('active'),
        ]);

        if($this->currentRequest->has('image')) {
            foreach ($this->currentRequest->input('image') as $item) :
                $this->noticeImagesRepository->create([
                    'notice_id' => $noticeTask->id,
                    'media_id' => $item
                ]);
            endforeach;
        }

        return [
            'uuid' => $noticeTask->uuid
        ];
    }

    /**
     * @param String $noticeUUID
     * @throws ClientErrorException
     */
    public function noticeUpdate(String $noticeUUID) : void {
        $noticeTask = $this->noticeMastersRepository->defaultCustomFind('uuid', $noticeUUID);
        $validator = Validator::make($this->currentRequest->all(), [
            'category' => 'required|exists:codes,code_id',
            'title' => 'required',
            'content' => 'required',
            'image.*' => 'integer|exists:media_file_masters,id',
        ],
            [
                'category.required' => __('admin-site-manage.notice.category.required'),
                'category.exists' => __('admin-site-manage.notice.category.exists'),
                'title.required' => __('admin-site-manage.notice.title.required'),
                'content.required' => __('admin-site-manage.notice.content.required'),
                'image.*.integer' => __('admin-site-manage.notice.image.integer'),
                'image.*.exists' => __('admin-site-manage.notice.image.exists')
            ]);

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }

        $this->noticeMastersRepository->update($noticeTask->id, [
            'category' => $this->currentRequest->input('category'),
            'title' => $this->currentRequest->input('title'),
            'content' => $this->currentRequest->input('content'),
        ]);


        $this->noticeImagesRepository->deleteByCustomColumn('notice_id', $noticeTask->id);
        if($this->currentRequest->has('image')) {
            foreach ($this->currentRequest->input('image') as $item) :
                $this->noticeImagesRepository->create([
                    'notice_id' => $noticeTask->id,
                    'media_id' => $item
                ]);
            endforeach;
        }
    }

    /**
     * @throws ClientErrorException
     */
    public function noticeDelete() : void {
        $validator = Validator::make($this->currentRequest->all(), [
            'uuid' => 'required|array|min:1',
            'uuid.*' => 'exists:notice_masters,uuid'
        ],
            [
                'uuid.required' => __('admin-site-manage.notice.uuid.required'),
                'uuid.array' => __('admin-site-manage.notice.uuid.array'),
                'uuid.*.exists' => __('admin-site-manage.notice.uuid.exists'),
            ]);

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }

        foreach ($this->currentRequest->input('uuid') as $uuid) {
            $notice = $this->noticeMastersRepository->defaultCustomFind('uuid', $uuid);


            $this->noticeMastersRepository->deleteById($notice->id);
            $this->noticeImagesRepository->deleteByCustomColumn('notice_id', $notice->id);
        }
    }

    /**
     * @param String $noticeUUID
     * @return array
     */
    public function noticeDetail(String $noticeUUID) : array {

        $task = $this->noticeMastersRepository->defaultDetail($noticeUUID)->toArray();

        return [
            'uuid' => $task['uuid'],
            'category' => [
                'code_id' => $task['category']['code_id'],
                'code_name' => $task['category']['code_name']
            ],
            'title' => $task['title'],
            'content' => [
                'default' => $task['content'],
            ],
            'active' => $task['active'],
            'images' => array_map(function($item) {
                return [
                    'uid' => $item['image']['id'],
                    'url' => env('APP_MEDIA_URL') . $item['image']['dest_path'] . '/' . $item['image']['file_name'],
                    'file_name' => $item['image']['file_name'],
                ];
            } , $task['images']),
            'created_at' => Carbon::parse($task['created_at'])->format('Y년 m월 d일'),
            'updated_at' => Carbon::parse($task['updated_at'])->format('Y년 m월 d일'),
        ];
    }

    /**
     * @return array
     */
    public function defaultShowNotice() : array {
        return array_map(function($item) {
            return [
                'id' => $item['id'],
                'uuid' => $item['uuid'],
                'category' => [
                    'code_id' => $item['category']['id'],
                    'code_name' => $item['category']['code_name']
                ],
                'title' => $item['title'],
                'content' => [
                    'default' => $item['content'],
                ],
                'active' => $item['active'],
                'images' => array_map(function($item) {
                    return env('APP_MEDIA_URL') . $item['image']['dest_path'] . '/' . $item['image']['file_name'];
                } , $item['images']),
                'created_at' => Carbon::parse($item['created_at'])->format('Y년 m월 d일'),
                'updated_at' => Carbon::parse($item['updated_at'])->format('Y년 m월 d일'),
            ];
        }, $this->noticeMastersRepository->getAdminNoticeListMaster()->toArray());
    }
}
