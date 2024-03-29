<?php

namespace App\Repositories;

use App\Models\Company;
use App\Repositories\Contracts\CompanyRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentCompanyRepository implements CompanyRepositoryInterface
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
        return Company::query()
            ->paginate(
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
        return Company::query()
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
        return Company::query()
            ->findOrFail($id)
            ->delete();
    }
}
