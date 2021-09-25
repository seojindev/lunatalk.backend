<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainSlides extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'media_id',
        'main_slide_id',
        'link',
        'active'
    ];

    public function image() {
        return $this->hasOne(MediaFileMasters::class,'id','media_id');
    }
}
