<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'category',
        'product_id',
    ];

    public function product() {
        return $this->hasOne(ProductMasters::class, 'id', 'product_id');
    }
}
