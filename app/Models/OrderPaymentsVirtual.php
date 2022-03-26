<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderPaymentsVirtual
 *
 * @property int $id
 * @property int|null $pay_id 페이 번호
 * @property string $accountNumber
 * @property string $accountType
 * @property string $bank
 * @property string $customerName
 * @property string $dueDate
 * @property string $expired
 * @property string $settlementStatus
 * @property string $refundStatus
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\OrderPaymentsVirtualFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPaymentsVirtual newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPaymentsVirtual newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPaymentsVirtual query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPaymentsVirtual whereAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPaymentsVirtual whereAccountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPaymentsVirtual whereBank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPaymentsVirtual whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPaymentsVirtual whereCustomerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPaymentsVirtual whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPaymentsVirtual whereExpired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPaymentsVirtual whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPaymentsVirtual wherePayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPaymentsVirtual whereRefundStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPaymentsVirtual whereSettlementStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPaymentsVirtual whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrderPaymentsVirtual extends Model
{
    use HasFactory;
}
