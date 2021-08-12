<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ProductWiredOptions
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductWiredOptions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductWiredOptions newQuery()
 * @method static \Illuminate\Database\Query\Builder|ProductWiredOptions onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductWiredOptions query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductWiredOptions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductWiredOptions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductWiredOptions whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ProductWiredOptions withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductWiredOptions withoutTrashed()
 * @mixin \Eloquent
 * @property string $wired 유무선 유무.
 * @property string $active 상태.
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductWiredOptions whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductWiredOptions whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductWiredOptions whereWired($value)
 */
class ProductWiredOptions extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'wired',
        'active'
    ];
}
