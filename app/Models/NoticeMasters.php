<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\NoticeMasters
 *
 * @property int $id
 * @property string $uuid uuid
 * @property \App\Models\Codes|null $category 공지사랑 카테고리.
 * @property string $title 제목.
 * @property string|null $content 내용.
 * @property string $active 상태
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\NoticeImages[] $images
 * @property-read int|null $images_count
 * @method static \Database\Factories\NoticeMastersFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|NoticeMasters newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NoticeMasters newQuery()
 * @method static \Illuminate\Database\Query\Builder|NoticeMasters onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|NoticeMasters query()
 * @method static \Illuminate\Database\Eloquent\Builder|NoticeMasters whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoticeMasters whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoticeMasters whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoticeMasters whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoticeMasters whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoticeMasters whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoticeMasters whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoticeMasters whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoticeMasters whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|NoticeMasters withTrashed()
 * @method static \Illuminate\Database\Query\Builder|NoticeMasters withoutTrashed()
 * @mixin \Eloquent
 */
class NoticeMasters extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'uuid',
        'category',
        'title',
        'content',
        'active'
    ];

    /**
     * @return HasOne
     */
    public function category() : hasOne {
        return $this->hasOne(Codes::class, 'code_id', 'category');
    }

    /**
     * @return HasMany
     */
    public function images() : hasMany {
        return $this->hasMany(NoticeImages::class, 'notice_id', 'id');
    }
}
