<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;


    protected $table = 'products';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'uuid',
        'category',
        'name',
        'barcode',
        'price',
        'stock',
        'memo',
        'sale',
        'active'
    ];

    public function category()
    {
        return $this->hasOne('App\Models\Codes', 'code_id', 'category');
    }

    public function options()
    {
        return $this->hasMany('App\Models\ProductOptions', 'product_id', 'id');
    }

    public function images()
    {
        return $this->hasMany('App\Models\ProductImages', 'product_id', 'id');
    }
}
