<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentUserRepository implements UserRepositoryInterface
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
        return User::query()->paginate(
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
        return User::query()
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
        return User::query()->findOrFail($id)->delete();
    }
}
