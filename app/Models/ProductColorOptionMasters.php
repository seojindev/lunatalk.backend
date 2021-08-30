<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\ProductColorOptions
 *
 * @property int $id
 * @property string $name 컬러명
 * @property string $eng_name 컬러 영문 명
 * @property string $active 성태
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder|ProductColorOptionMasters newModelQuery()
 * @method static Builder|ProductColorOptionMasters newQuery()
 * @method static \Illuminate\Database\Query\Builder|ProductColorOptionMasters onlyTrashed()
 * @method static Builder|ProductColorOptionMasters query()
 * @method static Builder|ProductColorOptionMasters whereActive($value)
 * @method static Builder|ProductColorOptionMasters whereCreatedAt($value)
 * @method static Builder|ProductColorOptionMasters whereDeletedAt($value)
 * @method static Builder|ProductColorOptionMasters whereEngName($value)
 * @method static Builder|ProductColorOptionMasters whereId($value)
 * @method static Builder|ProductColorOptionMasters whereName($value)
 * @method static Builder|ProductColorOptionMasters whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ProductColorOptionMasters withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductColorOptionMasters withoutTrashed()
 * @mixin Eloquent
 */
class ProductColorOptionMasters extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'name',
        'eng_name',
        'active'
    ];
}
