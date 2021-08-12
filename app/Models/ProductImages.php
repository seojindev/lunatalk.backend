<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImages extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'product_uuid',
        'media_category',
        'media_id',
        'active'
    ];
}
