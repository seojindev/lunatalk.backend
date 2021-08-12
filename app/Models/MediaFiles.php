<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MediaFiles
 *
 * @method static \Database\Factories\MediaFilesFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFiles newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFiles newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFiles query()
 * @mixin \Eloquent
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFiles whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFiles whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFiles whereUpdatedAt($value)
 * @property string $media_name 미디어명.
 * @property string $media_category 미디어 구분.
 * @property string $dest_path 저장 디렉토리 경로.
 * @property string $file_name 파일명.
 * @property string $original_name 원본 파일명.
 * @property string $file_type 원본 파일 타입.
 * @property int $file_size 파일 용량.
 * @property string $file_extension 파일 확장자.
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFiles whereDestPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFiles whereFileExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFiles whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFiles whereFileSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFiles whereFileType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFiles whereMediaCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFiles whereMediaName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFiles whereOriginalName($value)
 */
class MediaFiles extends Model
{
    use HasFactory;
}
