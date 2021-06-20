<?php


namespace App\Repositories;

use App\Models\MediaFiles;

/**
 * Class MediaRepository
 * @package App\Repositories
 */
class MediaRepository implements MediaRepositoryInterface
{
    /**
     * @var MediaFiles
     */
    protected MediaFiles $MediaFiles;

    /**
     * MediaRepository constructor.
     * @param MediaFiles $mediafiles
     */
    public function __construct(MediaFiles $mediafiles)
    {
        $this->MediaFiles = $mediafiles;

    }

    /**
     * media 파일 업로드.
     * @param array $dataObject
     * @return mixed
     */
    public function createMediaFile(Array $dataObject)
    {
        return $this->MediaFiles::create($dataObject);
    }

}
