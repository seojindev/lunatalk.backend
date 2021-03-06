<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array|string[] $columns
     * @param array $relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->with($relations)->get($columns);
    }

    /**
     * @return Collection
     */
    public function defaultAll(): Collection
    {
        return $this->model->where('active', 'Y')->orderBy('id')->get();
    }

    /**
     * @param int $modelId
     * @param array|string[] $columns
     * @param array $relations
     * @param array $appends
     * @return Model|null
     */
    public function findById(int $modelId, array $columns = ['*'], array $relations = [], array $appends = []): ?Model
    {
        return $this->model->select($columns)->with($relations)->findOrFail($modelId)->append($appends);
    }

    /**
     * @param string $columnsName
     * @param string $value
     * @return Model|null
     */
    public function defaultCustomFind(string $columnsName, string $value): ?Model
    {
        return $this->model->where($columnsName, $value)->firstOrFail();
    }

    /**
     * @param string $columnsName
     * @param string $value
     * @return Collection|null
     */
    public function defaultGetCustomFind(string $columnsName, string $value): ?Collection
    {
        return $this->model->where($columnsName, $value)->get();
    }

    /**
     * @param int $modelId
     * @return Model|null
     */
    public function defaultFindById(int $modelId): ?Model
    {
        return $this->model->where('id', $modelId)->firstOrFail();
    }

    /**
     * @param string $columnsName
     * @param string $value
     * @return bool
     */
    public function defaultExistsColumn(string $columnsName, string $value): bool
    {
        return $this->model->where($columnsName, $value)->exists();
    }

    /**
     * @param array $payload
     * @return Model|null
     */
    public function create(array $payload): ?Model
    {
        $model = $this->model->create($payload);

        return $model->fresh();
    }

    /**
     * @param int $modelId
     * @param array $payload
     * @return bool
     */
    public function update(int $modelId, array $payload): bool
    {
        $model = $this->findById($modelId);

        return $model->update($payload);
    }

    /**
     * @param string $targetColumnsName
     * @param string $columnName
     * @param array $payload
     * @return bool
     */
    public function updateByCustomColumn(string $targetColumnsName, string $columnName, array $payload): bool
    {

        return $this->model->where($targetColumnsName, $columnName)->update($payload);
    }

    /**
     * @param int $modelId
     * @return bool
     */
    public function deleteById(int $modelId): bool
    {
        return $this->findById($modelId)->delete();
    }

    /**
     * @param string $columnsName
     * @param string $value
     * @return bool
     */
    public function deleteByCustomColumn(string $columnsName, string $value): bool
    {
        return $this->model->where($columnsName, $value)->delete();
    }
}
