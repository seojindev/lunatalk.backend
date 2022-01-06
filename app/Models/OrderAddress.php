<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderAddress
 *
 * @property int $id
 * @property int|null $order_id 오더 번호
 * @property string $zipcode 우편번호
 * @property string $step1 주소
 * @property string $step2 상세 주소
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\OrderAddressFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddress query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddress whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddress whereStep1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddress whereStep2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddress whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderAddress whereZipcode($value)
 * @mixin \Eloquent
 */
class OrderAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'zipcode',
        'step1',
        'step2',

    ];
}
