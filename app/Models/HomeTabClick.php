<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\HomeTabClick
 *
 * @property int $id
 * @property string|null $home_main_uid 홈 메인 uid.
 * @property string|null $category_code 상품 카테고리 코드.
 * @property string|null $remote_addr IP.
 * @property string $header request header.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|HomeTabClick newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HomeTabClick newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HomeTabClick query()
 * @method static \Illuminate\Database\Eloquent\Builder|HomeTabClick whereCategoryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeTabClick whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeTabClick whereHeader($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeTabClick whereHomeMainUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeTabClick whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeTabClick whereRemoteAddr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeTabClick whereUpdatedAt($value)
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
