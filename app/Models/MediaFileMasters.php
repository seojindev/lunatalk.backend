<?php

namespace App\Models;

use Database\Factories\MediaFileMastersFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\MediaFileMasters
 *
 * @property int $id
 * @property string $media_name 미디어명.
 * @property string $media_category 미디어 구분.
 * @property string $dest_path 저장 디렉토리 경로.
 * @property string $file_name 파일명.
 * @property string $original_name 원본 파일명.
 * @property string $file_type 원본 파일 타입.
 * @property int $file_size 파일 용량.
 * @property string $file_extension 파일 확장자.
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Database\Factories\MediaFileMastersFactory factory(...$parameters)
 * @method static Builder|MediaFileMasters newModelQuery()
 * @method static Builder|MediaFileMasters newQuery()
 * @method static Builder|MediaFileMasters query()
 * @method static Builder|MediaFileMasters whereCreatedAt($value)
 * @method static Builder|MediaFileMasters whereDestPath($value)
 * @method static Builder|MediaFileMasters whereFileExtension($value)
 * @method static Builder|MediaFileMasters whereFileName($value)
 * @method static Builder|MediaFileMasters whereFileSize($value)
 * @method static Builder|MediaFileMasters whereFileType($value)
 * @method static Builder|MediaFileMasters whereId($value)
 * @method static Builder|MediaFileMasters whereMediaCategory($value)
 * @method static Builder|MediaFileMasters whereMediaName($value)
 * @method static Builder|MediaFileMasters whereOriginalName($value)
 * @method static Builder|MediaFileMasters whereUpdatedAt($value)
 * @mixin Eloquent
 */
class MediaFileMasters extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'media_name',
        'media_category',
        'dest_path',
        'file_name',
        'original_name',
        'file_type',
        'file_size',
        'file_extension'
    ];
}
