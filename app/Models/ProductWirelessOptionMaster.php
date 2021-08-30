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
 * @method static Builder|ProductWirelessOptionMaster newModelQuery()
 * @method static Builder|ProductWirelessOptionMaster newQuery()
 * @method static \Illuminate\Database\Query\Builder|ProductWirelessOptionMaster onlyTrashed()
 * @method static Builder|ProductWirelessOptionMaster query()
 * @method static \Illuminate\Database\Query\Builder|ProductWirelessOptionMaster withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductWirelessOptionMaster withoutTrashed()
 * @mixin Eloquent
 * @property int $id
 * @property string $wireless 유무선 유무.
 * @property string $active 상태.
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder|ProductWirelessOptionMaster whereActive($value)
 * @method static Builder|ProductWirelessOptionMaster whereCreatedAt($value)
 * @method static Builder|ProductWirelessOptionMaster whereDeletedAt($value)
 * @method static Builder|ProductWirelessOptionMaster whereId($value)
 * @method static Builder|ProductWirelessOptionMaster whereUpdatedAt($value)
 * @method static Builder|ProductWirelessOptionMaster whereWireless($value)
 */
class ProductWirelessOptionMaster extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'wireless',
        'active'
    ];
}
