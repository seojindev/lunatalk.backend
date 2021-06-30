<?php


namespace App\Repositories;

use App\Models\HomeMains;

/**
 * Class AdminRepository
 * @package App\Repositories
 */
class AdminRepository implements AdminRepositoryInterface
{
    protected HomeMains $homeMains;

    public function __construct(HomeMains $homeMains)
    {
        $this->homeMains = $homeMains;
    }

    /**
     * @param Int $id
     * @return object
     */
    public function findHomeMain(Int $id) : object
    {
        return $this->homeMains::where('id', $id)->firstOrFail();
    }

    /**
     * 홈 메인 생성.
     * @param array $dataElement
     * @return object
     */
    public function createHomeMain(Array $dataElement) : object
    {
        return $this->homeMains::create($dataElement);
    }

    /**
     * 홈 메인 삭제.
     * @param Int $id
     * @return bool
     */
    public function deleteHomeMain(Int $id) : bool
    {
        return $this->homeMains::where('id', $id)->delete();
    }

    /**
     * 홈 메인 수정.
     * @param Int $id
     * @param array $dataElement
     * @return bool
     */
    public function updateHomeMain(Int $id, Array $dataElement) : bool
    {
        return $this->homeMains::where('id', $id)->update($dataElement);
    }

    /**
     * 홈 메인 상태 업데이트
     * @param Int $id
     * @param string $status
     * @return bool
     */
    public function updateHomeMainStatus(Int $id, string $status) : bool
    {
        return $this->homeMains::where('id', $id)->update(['status' => $status]);
    }
}
