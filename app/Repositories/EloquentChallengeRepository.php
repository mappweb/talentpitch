<?php

namespace App\Repositories;

use App\Models\Challenge;
use App\Repositories\Contracts\ChallengeRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentChallengeRepository implements ChallengeRepositoryInterface
{
    /**
     * @param $perPage
     * @param $columns
     * @param $pageName
     * @param $page
     * @return LengthAwarePaginator
     */
    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): LengthAwarePaginator
    {
        return Challenge::query()->paginate(
            $perPage ?? 10,
                $columns,
                $pageName,
                $page ?? 1,
        );
    }

    /**
     * @param $attributes
     * @param $id
     * @return mixed
     */
    public function createOrUpdate($attributes, $id = null): mixed
    {
        return Challenge::query()
            ->updateOrCreate(
                ['id' => $id],
                $attributes
            );
    }

    /**
     * @param $id
     * @return bool|mixed|null
     */
    public function delete($id): mixed
    {
        return Challenge::query()
            ->findOrFail($id)
            ->delete();
    }
}
