<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\NoticeImages
 *
 * @property int $id
 * @property int $notice_id 공지사항 id
 * @property int|null $media_id 공지사항 이미지.
 * @property string $active 상태.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\NoticeImagesFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|NoticeImages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NoticeImages newQuery()
 * @method static \Illuminate\Database\Query\Builder|NoticeImages onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|NoticeImages query()
 * @method static \Illuminate\Database\Eloquent\Builder|NoticeImages whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoticeImages whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoticeImages whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoticeImages whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoticeImages whereMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoticeImages whereNoticeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoticeImages whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|NoticeImages withTrashed()
 * @method static \Illuminate\Database\Query\Builder|NoticeImages withoutTrashed()
 * @mixin \Eloquent
 */
class NoticeImages extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'notice_id',
        'media_id',
        'active',
    ];

    /**
     * @return HasOne
     */
    public function image() : hasOne {
        return $this->hasOne(MediaFileMasters::class, 'id', 'media_id');
    }
}
