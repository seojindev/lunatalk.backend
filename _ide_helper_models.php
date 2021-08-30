<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Codes
 *
 * @property int $id
 * @property string $group_id
 * @property string|null $code_id
 * @property string|null $group_name
 * @property string|null $code_name
 * @property string $active 사용 상태(사용중, 비사용)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Codes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Codes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Codes query()
 * @method static \Illuminate\Database\Eloquent\Builder|Codes whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Codes whereCodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Codes whereCodeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Codes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Codes whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Codes whereGroupName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Codes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Codes whereUpdatedAt($value)
 */
	class Codes extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\HomeMains
 *
 * @property int $id
 * @property string|null $uid uid.
 * @property \App\Models\Codes|null $gubun 구분.
 * @property int $product_id 상품 고유값.
 * @property int|null $media_id 이미지 아이디.
 * @property string $status 상태.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\MediaFileMasters|null $media_file
 * @property-read \App\Models\Products|null $product
 * @method static \Database\Factories\HomeMainsFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeMains newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HomeMains newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HomeMains query()
 * @method static \Illuminate\Database\Eloquent\Builder|HomeMains whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeMains whereGubun($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeMains whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeMains whereMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeMains whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeMains whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeMains whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeMains whereUpdatedAt($value)
 */
	class HomeMains extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\HomeTabClick
 *
 * @property int $id
 * @property string|null $home_main_uid 홈 메인 uid.
 * @property string|null $category_code 상품 카테고리 코드.
 * @property string|null $remote_addr IP.
 * @property string $header request header.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|HomeTabClick newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HomeTabClick newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HomeTabClick query()
 * @method static \Illuminate\Database\Eloquent\Builder|HomeTabClick whereCategoryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeTabClick whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeTabClick whereHeader($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeTabClick whereHomeMainUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeTabClick whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeTabClick whereRemoteAddr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeTabClick whereUpdatedAt($value)
 */
	class HomeTabClick extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MediaFiles
 *
 * @property int $id
 * @property string $media_name 미디어명.
 * @property string $media_category 미디어 구분.
 * @property string $dest_path 저장 디렉토리 경로.
 * @property string $file_name 파일명.
 * @property string $original_name 원본 파일명.
 * @property string $file_type 원본 파일 타입.
 * @property int $file_size 파일 용량.
 * @property string $file_extension 파일 확장자.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\MediaFilesFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFileMasters newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFileMasters newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFileMasters query()
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFileMasters whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFileMasters whereDestPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFileMasters whereFileExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFileMasters whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFileMasters whereFileSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFileMasters whereFileType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFileMasters whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFileMasters whereMediaCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFileMasters whereMediaName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFileMasters whereOriginalName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFileMasters whereUpdatedAt($value)
 */
	class MediaFiles extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductImages
 *
 * @property int $id
 * @property int $product_id 상품 고유값.
 * @property string|null $media_category 이미지 카테고리.
 * @property int|null $media_id 제품 썸네일 이미지.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Codes|null $category
 * @property-read \App\Models\MediaFileMasters|null $mediafile
 * @method static \Database\Factories\ProductImagesFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages whereMediaCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages whereMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages whereUpdatedAt($value)
 */
	class ProductImages extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductOptions
 *
 * @property int $id
 * @property int $product_id 상품 번호.
 * @property \App\Models\Codes|null $step1 상품 옵션 1.
 * @property \App\Models\Codes|null $step2 상품 옵션 2.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ProductOptionsFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOptions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOptions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOptions query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOptions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOptions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOptions whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOptions whereStep1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOptions whereStep2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOptions whereUpdatedAt($value)
 */
	class ProductOptions extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Products
 *
 * @property int $id
 * @property string $uuid 상품 uuid.
 * @property \App\Models\Codes|null $category 상품 카테고리.
 * @property string $name 상품명.
 * @property string|null $barcode 상품 비코드.
 * @property int $price 상품 가격.
 * @property int $stock 상품 재고 수량.
 * @property string|null $memo 상품 메모.
 * @property int $view_count 뷰 카운트.
 * @property string $sale 상품 판매 유무.
 * @property string $active 상품 상태.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\HomeMains[] $homeMain
 * @property-read int|null $home_main_count
 * @property-read \App\Models\HomeMains|null $home_best_item
 * @property-read \App\Models\HomeMains|null $home_hot_item
 * @property-read \App\Models\HomeMains|null $home_top_item
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductImages[] $images
 * @property-read int|null $images_count
 * @property-read \App\Models\ProductOptions|null $options
 * @property-read \App\Models\ProductImages|null $rep_image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductImages[] $rep_images
 * @property-read int|null $rep_images_count
 * @method static \Database\Factories\ProductsFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Products newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Products newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Products query()
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereBarcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereSale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereViewCount($value)
 */
	class Products extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $user_uuid 회원 uuid
 * @property \App\Models\Codes|null $user_type 회원 타입
 * @property \App\Models\Codes|null $user_level 회원 레벨
 * @property \App\Models\Codes|null $user_state 회원 상태.
 * @property string $login_id
 * @property string $nickname 회원 닉네임
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property string $phone_number 회원 휴대폰 번호.
 * @property string $active 회원 상태
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLoginId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserUuid($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserPhoneVerify
 *
 * @property int $id
 * @property int|null $user_id 회원 번호
 * @property string $phone_number 인증 전화 번호
 * @property string $auth_code 인증 코드
 * @property string|null $verified 인증 상태
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\UserPhoneVerifyFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPhoneVerify newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPhoneVerify newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPhoneVerify query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPhoneVerify whereAuthCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPhoneVerify whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPhoneVerify whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPhoneVerify wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPhoneVerify whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPhoneVerify whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPhoneVerify whereVerified($value)
 */
	class UserPhoneVerify extends \Eloquent {}
}

