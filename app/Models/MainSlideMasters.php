<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainSlideMasters extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'uuid',
        'name',
        'active'
    ];

    public function image()
    {
        return $this->hasOne(MainSlides::class,'main_slide_id','id');
    }
};
