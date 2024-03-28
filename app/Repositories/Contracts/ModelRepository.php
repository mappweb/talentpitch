<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ModelRepository
{
    /**
     * @param $perPage
     * @param $columns
     * @param $pageName
     * @param $page
     * @return LengthAwarePaginator
     */
    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): LengthAwarePaginator;

    /**
     * @param $attributes
     * @param $id
     * @return mixed
     */
    public function createOrUpdate($attributes, $id = null): mixed;

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id): mixed;
}
