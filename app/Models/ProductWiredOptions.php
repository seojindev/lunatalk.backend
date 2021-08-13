<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\ProductWiredOptions
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|ProductWiredOptions newModelQuery()
 * @method static Builder|ProductWiredOptions newQuery()
 * @method static \Illuminate\Database\Query\Builder|ProductWiredOptions onlyTrashed()
 * @method static Builder|ProductWiredOptions query()
 * @method static Builder|ProductWiredOptions whereCreatedAt($value)
 * @method static Builder|ProductWiredOptions whereId($value)
 * @method static Builder|ProductWiredOptions whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ProductWiredOptions withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductWiredOptions withoutTrashed()
 * @mixin Eloquent
 * @property string $wired 유무선 유무.
 * @property string $active 상태.
 * @property Carbon|null $deleted_at
 * @method static Builder|ProductWiredOptions whereActive($value)
 * @method static Builder|ProductWiredOptions whereDeletedAt($value)
 * @method static Builder|ProductWiredOptions whereWired($value)
 */
class ProductWiredOptions extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'wired',
        'active'
    ];
}
