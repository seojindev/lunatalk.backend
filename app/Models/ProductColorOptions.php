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
 * @property string|null $deleted_at
 * @method static Builder|ProductColorOptions newModelQuery()
 * @method static Builder|ProductColorOptions newQuery()
 * @method static Builder|ProductColorOptions query()
 * @method static Builder|ProductColorOptions whereActive($value)
 * @method static Builder|ProductColorOptions whereCreatedAt($value)
 * @method static Builder|ProductColorOptions whereDeletedAt($value)
 * @method static Builder|ProductColorOptions whereEngName($value)
 * @method static Builder|ProductColorOptions whereId($value)
 * @method static Builder|ProductColorOptions whereName($value)
 * @method static Builder|ProductColorOptions whereUpdatedAt($value)
 * @mixin Eloquent
 * @method static \Illuminate\Database\Query\Builder|ProductColorOptions onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductColorOptions withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductColorOptions withoutTrashed()
 */
class ProductColorOptions extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'name',
        'eng_name',
        'active'
    ];
}
