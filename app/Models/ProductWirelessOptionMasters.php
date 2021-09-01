<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\ProductWirelessOptions
 *
 * @method static Builder|ProductWirelessOptionMasters newModelQuery()
 * @method static Builder|ProductWirelessOptionMasters newQuery()
 * @method static \Illuminate\Database\Query\Builder|ProductWirelessOptionMasters onlyTrashed()
 * @method static Builder|ProductWirelessOptionMasters query()
 * @method static \Illuminate\Database\Query\Builder|ProductWirelessOptionMasters withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductWirelessOptionMasters withoutTrashed()
 * @mixin Eloquent
 * @property int $id
 * @property string $wireless 유무선 유무.
 * @property string $active 상태.
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder|ProductWirelessOptionMasters whereActive($value)
 * @method static Builder|ProductWirelessOptionMasters whereCreatedAt($value)
 * @method static Builder|ProductWirelessOptionMasters whereDeletedAt($value)
 * @method static Builder|ProductWirelessOptionMasters whereId($value)
 * @method static Builder|ProductWirelessOptionMasters whereUpdatedAt($value)
 * @method static Builder|ProductWirelessOptionMasters whereWireless($value)
 */
class ProductWirelessOptionMasters extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'wireless',
        'active'
    ];
}
