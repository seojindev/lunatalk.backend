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
 * @method static Builder|ProductWirelessOptions newModelQuery()
 * @method static Builder|ProductWirelessOptions newQuery()
 * @method static \Illuminate\Database\Query\Builder|ProductWirelessOptions onlyTrashed()
 * @method static Builder|ProductWirelessOptions query()
 * @method static \Illuminate\Database\Query\Builder|ProductWirelessOptions withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductWirelessOptions withoutTrashed()
 * @mixin Eloquent
 * @property int $id
 * @property string $wireless 유무선 유무.
 * @property string $active 상태.
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder|ProductWirelessOptions whereActive($value)
 * @method static Builder|ProductWirelessOptions whereCreatedAt($value)
 * @method static Builder|ProductWirelessOptions whereDeletedAt($value)
 * @method static Builder|ProductWirelessOptions whereId($value)
 * @method static Builder|ProductWirelessOptions whereUpdatedAt($value)
 * @method static Builder|ProductWirelessOptions whereWireless($value)
 */
class ProductWirelessOptions extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'wireless',
        'active'
    ];
}
