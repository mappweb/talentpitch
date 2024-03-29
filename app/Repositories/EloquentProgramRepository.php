<?php

namespace App\Repositories;

use App\Models\Program;
use App\Repositories\Contracts\ProgramRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentProgramRepository implements ProgramRepositoryInterface
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
        return Program::query()->paginate(
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
        return Program::query()
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
        return Program::query()
            ->findOrFail($id)
            ->delete();
    }
}
