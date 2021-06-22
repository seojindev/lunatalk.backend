<?php

namespace Tests\Feature\Api\MediaController;

use App\Exceptions\ClientErrorException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\BaseCustomTestCase;
use Illuminate\Http\UploadedFile;

class CreateTest extends BaseCustomTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    // 로그인 안되어 있을때.

    // 라우터 에러.
    public function test_media_네임_없을때_라우터_에러()
    {
        $this->expectException(NotFoundHttpException::class);

        $this->withHeaders($this->getTestAccessTokenHeader())->json('POST', '/api/v1/other/media///create');
    }
    // 이미지 없을때.
    public function test_media_카테고리명_없을떄_라우터_에러()
    {
        $this->expectException(NotFoundHttpException::class);

        $this->withHeaders($this->getTestAccessTokenHeader())->json('POST', '/api/v1/other/media/products//create');
    }

    // 이미지 파일 없을떄.
    public function test_media_파일_없이_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('message.required.media_file'));

        $this->withHeaders($this->getTestAccessTokenHeader())->json('POST', '/api/v1/other/media/products/rep/create', []);
    }

    // 등록 가능한 이미지 파일 아닐때.
    public function test_media_이미지외_다른_파일_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('message.other.image_check'));

        $file = UploadedFile::fake()->create('document.pdf', 300, 'application/pdf');

        $this->withHeaders($this->getTestAccessTokenHeader())->json('POST', '/api/v1/other/media/products/rep/create', [
            'media_file' => $file
        ]);


        $file = UploadedFile::fake()->create('document.pdf', 300, 'application/pdf1');

        $this->withHeaders($this->getTestAccessTokenHeader())->json('POST', '/api/v1/other/media/products/rep/create', [
            'media_file' => $file
        ]);
    }

    // 이미지 사이즈 초과.
    public function test_media_이미지_사이즈_초과_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('message.other.image_max'));

        $file = UploadedFile::fake()->create('test_image.jpeg', 30000000, 'image/jpeg');

        $this->withHeaders($this->getTestAccessTokenHeader())->json('POST', '/api/v1/other/media/products/rep/create', [
            'media_file' => $file
        ]);
    }

    // 정상
    // 정상일때 테스트시는 이미지가 직접 올라가기 떄문에 뺌.
//    public function test_media_정상_요청()
//    {
//        $file = UploadedFile::fake()->create('test_image.jpeg', 300, 'image/jpeg');
//
//        $this->withHeaders($this->getTestAccessTokenHeader())->json('POST', '/api/v1/other/media/products/rep/create', [
//            'media_file' => $file
//        ])->assertStatus(200)->assertJsonStructure([
//            'message',
//            'result' => [
//                'media_id',
//                'media_name',
//                'media_category',
//                'media_full_url'
//            ]
//        ]);
//    }
}
