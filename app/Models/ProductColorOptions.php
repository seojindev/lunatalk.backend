<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ProductColorOptions
 *
 * @property int $id
 * @property string $name 컬러명
 * @property string $eng_name 컬러 영문 명
 * @property string $active 성태
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColorOptions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColorOptions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColorOptions query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColorOptions whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColorOptions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColorOptions whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColorOptions whereEngName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColorOptions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColorOptions whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColorOptions whereUpdatedAt($value)
 * @mixin \Eloquent
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
