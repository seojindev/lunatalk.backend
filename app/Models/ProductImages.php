<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'products_images';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'product_id',
        'media_category',
        'media_id'
    ];

    public function category()
    {
        return $this->hasOne('App\Models\Codes', 'code_id', 'media_category');
    }

    public function mediafile()
    {
        return $this->hasOne('App\Models\MediaFiles', 'id', 'media_id');
    }
}
