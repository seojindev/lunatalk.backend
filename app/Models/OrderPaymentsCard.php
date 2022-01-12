<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderPaymentsCard
 *
 * @property int $id
 * @property int|null $pay_id 페이 번호
 * @property string $company
 * @property string $number
 * @property string $installmentPlanMonths
 * @property string $isInterestFree
 * @property string $approveNo
 * @property string $useCardPoint
 * @property string $cardType
 * @property string $ownerType
 * @property string $acquireStatus
 * @property string $receiptUrl
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\OrderPaymentsCardFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPaymentsCard newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPaymentsCard newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPaymentsCard query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPaymentsCard whereAcquireStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPaymentsCard whereApproveNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPaymentsCard whereCardType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPaymentsCard whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPaymentsCard whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPaymentsCard whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPaymentsCard whereInstallmentPlanMonths($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPaymentsCard whereIsInterestFree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPaymentsCard whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPaymentsCard whereOwnerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPaymentsCard wherePayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPaymentsCard whereReceiptUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPaymentsCard whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPaymentsCard whereUseCardPoint($value)
 * @mixin \Eloquent
 */
class OrderPaymentsCard extends Model
{
    use HasFactory;
}
