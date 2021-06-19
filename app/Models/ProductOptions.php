<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductOptions
 *
 * @property int $id
 * @property int $product_id 상품 번호.
 * @property \App\Models\Codes|null $step1 상품 옵션 1.
 * @property \App\Models\Codes|null $step2 상품 옵션 2.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOptions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOptions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOptions query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOptions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOptions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOptions whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOptions whereStep1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOptions whereStep2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductOptions whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductOptions extends Model
{
    use HasFactory;


    /**
     * @var string
     */
    protected $table = 'products_options';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'product_id',
        'step1',
        'step2'
    ];

    public function step1()
    {
        return $this->hasOne('App\Models\Codes', 'code_id', 'step1');
    }

    public function step2()
    {
        return $this->hasOne('App\Models\Codes', 'code_id', 'step2');
    }
}
