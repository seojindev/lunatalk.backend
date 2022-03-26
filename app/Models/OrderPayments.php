<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderPayments
 *
 * @property int $id
 * @property int|null $order_id 오더 번호
 * @property string $mId
 * @property string $version
 * @property string $transactionKey
 * @property string $paymentKey
 * @property string $orderId
 * @property string $orderName
 * @property string $method
 * @property string $status
 * @property string $requestedAt
 * @property string $approvedAt
 * @property string $useEscrow
 * @property string $cultureExpense
 * @property string $transfer
 * @property string $mobilePhone
 * @property string $giftCertificate
 * @property string $cashReceipt
 * @property string $discount
 * @property string $cancels
 * @property string $secret
 * @property string $type
 * @property string $easyPay
 * @property string $currency
 * @property string $totalAmount
 * @property string $balanceAmount
 * @property string $suppliedAmount
 * @property string $vat
 * @property string $taxFreeAmount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\OrderPaymentsCard|null $cards
 * @property-read \App\Models\OrderPaymentsVirtual|null $virtuals
 * @method static \Database\Factories\OrderPaymentsFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments whereBalanceAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments whereCancels($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments whereCashReceipt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments whereCultureExpense($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments whereEasyPay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments whereGiftCertificate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments whereMId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments whereMobilePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments whereOrderName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments wherePaymentKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments whereRequestedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments whereSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments whereSuppliedAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments whereTaxFreeAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments whereTransactionKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments whereTransfer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments whereUseEscrow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments whereVat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPayments whereVersion($value)
 * @mixin \Eloquent
 */
class OrderPayments extends Model
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cards() {
        return $this->hasOne(OrderPaymentsCard::class, 'pay_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function virtuals() {
        return $this->hasOne(OrderPaymentsVirtual::class, 'pay_id', 'id');
    }
}
