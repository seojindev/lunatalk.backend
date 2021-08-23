<?php

namespace App\Models;

use Database\Factories\MediaFilesFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\MediaFiles
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
 * @method static \Database\Factories\MediaFilesFactory factory(...$parameters)
 * @method static Builder|MediaFiles newModelQuery()
 * @method static Builder|MediaFiles newQuery()
 * @method static Builder|MediaFiles query()
 * @method static Builder|MediaFiles whereCreatedAt($value)
 * @method static Builder|MediaFiles whereDestPath($value)
 * @method static Builder|MediaFiles whereFileExtension($value)
 * @method static Builder|MediaFiles whereFileName($value)
 * @method static Builder|MediaFiles whereFileSize($value)
 * @method static Builder|MediaFiles whereFileType($value)
 * @method static Builder|MediaFiles whereId($value)
 * @method static Builder|MediaFiles whereMediaCategory($value)
 * @method static Builder|MediaFiles whereMediaName($value)
 * @method static Builder|MediaFiles whereOriginalName($value)
 * @method static Builder|MediaFiles whereUpdatedAt($value)
 * @mixin Eloquent
 */
class MediaFiles extends Model
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
