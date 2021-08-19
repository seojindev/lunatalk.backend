<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * https://dev.to/carlomigueldy/getting-started-with-repository-pattern-in-laravel-using-inheritance-and-dependency-injection-2ohe
 */
interface EloquentRepositoryInterface
{
    /**
     * @param array|string[] $columns
     * @param array $relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection;

    /**
     * @param int $modelId
     * @param array|string[] $columns
     * @param array $relations
     * @param array $appends
     * @return Model|null
     */
    public function findById(int $modelId, array $columns = ['*'], array $relations = [], array $appends = []): ?Model;


    public function defaultCustomFind(string $columnsName, string $value): ?Model;

    public function defaultFindById(int $modelId): ?Model;
    public function defaultExistsColumn(string $columnsName, string $value): bool;


    /**
     * @param array $payload
     * @return Model|null
     */
    public function create(array $payload): ?Model;

    /**
     * @param int $modelId
     * @param array $payload
     * @return bool
     */
    public function update(int $modelId, array $payload): bool;

    /**
     * @param int $modelId
     * @return bool
     */
    public function deleteById(int $modelId): bool;

    /**
     * @return Collection
     */
    public function defaultall(): Collection;
}
