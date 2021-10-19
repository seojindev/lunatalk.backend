<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MainSlideMasters
 *
 * @property int $id
 * @property string $uuid uuid
 * @property string $name 메인 슬라이드 이름
 * @property string $active 전체 상태
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MainSlides[] $image
 * @property-read int|null $image_count
 * @method static \Illuminate\Database\Eloquent\Builder|MainSlideMasters newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MainSlideMasters newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MainSlideMasters query()
 * @method static \Illuminate\Database\Eloquent\Builder|MainSlideMasters whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainSlideMasters whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainSlideMasters whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainSlideMasters whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainSlideMasters whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainSlideMasters whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainSlideMasters whereUuid($value)
 * @mixin \Eloquent
 */
class MainSlideMasters extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'uuid',
        'name',
        'media_id',
        'product_id',
        'slide_url',
        'memo',
        'active'
    ];

    public function image() {
        return $this->hasOne(MediaFileMasters::class, 'id', 'media_id');
    }

    public function product() {
        return $this->hasOne(ProductMasters::class, 'id', 'product_id');
    }
}
