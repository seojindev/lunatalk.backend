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
 */
class ProductWirelessOptions extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'wireless',
        'active'
    ];
}
