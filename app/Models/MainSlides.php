<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MainSlides
 *
 * @property int $id
 * @property int $media_id 메인 슬라이드 이미지
 * @property int $main_slide_id 메인 슬라이드 id
 * @property string $link 이동 url
 * @property string $active 메인 슬라이드 이미지 개별 상태
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\MediaFileMasters|null $image
 * @method static \Illuminate\Database\Eloquent\Builder|MainSlides newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MainSlides newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MainSlides query()
 * @method static \Illuminate\Database\Eloquent\Builder|MainSlides whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainSlides whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainSlides whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainSlides whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainSlides whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainSlides whereMainSlideId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainSlides whereMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainSlides whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MainSlides extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'media_id',
        'main_slide_id',
        'link',
        'active'
    ];

    public function image() {
        return $this->hasOne(MediaFileMasters::class,'id','media_id');
    }
}
