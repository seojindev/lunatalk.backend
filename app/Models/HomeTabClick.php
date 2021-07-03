<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\HomeTabClick
 *
 * @method static \Illuminate\Database\Eloquent\Builder|HomeTabClick newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HomeTabClick newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HomeTabClick query()
 * @mixin \Eloquent
 */
class HomeTabClick extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'home_tab_click';

    protected $fillable = [
        'id',
        'home_main_uid',
        'category_code',
        'remote_addr',
        'header'
    ];
}
