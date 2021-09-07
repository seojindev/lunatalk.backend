<?php

namespace Tests\Feature\Api\Other\v1\MediaController;

use App\Exceptions\ClientErrorException;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\BaseCustomTestCase;

class CreateTest extends BaseCustomTestCase
{
    use WithFaker;

    protected string $apiURL;
    protected string $GapiURL;

    public function setUp(): void
    {
        parent::setUp();

        $this->apiURL = "/api/other/v1/media/:mediaName:/:mediaCategory:/create";
        $this->GapiURL = "/api/other/v1/media/:mediaName:/:mediaCategory:/create";
    }

    // 라우터 에러.
//    public function test_other_v1_media_create_네임_없을때_라우터_에러()
    public function test_other_v1_media_create_제목_없이_요청()
    {
        $this->expectException(NotFoundHttpException::class);

        $apiURL = str_replace(':mediaName:', '', $this->apiURL);
        $apiURL = str_replace(':mediaName:', '', $apiURL);
        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $apiURL);
    }
    // 이미지 없을때.
    public function test_other_v1_media_create_카테고리명_없을떄_라우터_에러()
    {
        $this->expectException(NotFoundHttpException::class);

        $apiURL = str_replace(':mediaName:', 'products', $this->apiURL);
        $apiURL = str_replace(':mediaCategory:', '', $apiURL);

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $apiURL);
    }

    // 이미지 파일 없을떄.
    public function test_other_v1_media_create_파일_없이_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('default.media.media_file'));


        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->GapiURL, []);
    }

    // 등록 가능한 이미지 파일 아닐때.
    public function test_other_v1_media_create_이미지외_다른_파일_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('default.media.image_check'));

        $file = UploadedFile::fake()->create('document.pdf', 300, 'application/pdf');

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->GapiURL, [
            'media_file' => $file
        ]);


        $file = UploadedFile::fake()->create('document.pdf', 300, 'application/pdf1');

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->GapiURL, [
            'media_file' => $file
        ]);
    }

    // 이미지 사이즈 초과.
    public function test_other_v1_media_create_이미지_사이즈_초과_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('default.media.image_max'));

        $file = UploadedFile::fake()->create('test_image.jpeg', 30000000, 'image/jpeg');

        $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', $this->GapiURL, [
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
