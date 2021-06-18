<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
