<?php

namespace App\Http\Controllers\Api\V1\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Resources\Api\CompanyResource;
use App\Models\Company;
use App\Repositories\Contracts\CompanyRepositoryInterface;
use App\Traits\PaginateJsonResponse;
use Illuminate\Http\JsonResponse;

class UpdateCompanyController extends Controller
{
    use PaginateJsonResponse;

    /**
     * @var CompanyRepositoryInterface
     */
    private CompanyRepositoryInterface $repository;

    /**
     * Instance Constructor.
     *
     * @param CompanyRepositoryInterface $repository
     */
    public function __construct(CompanyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all videos.
     *
     * @param CompanyRequest $request
     * @param Company $company
     * @return JsonResponse
     */
   public function __invoke(CompanyRequest $request, Company $company): JsonResponse
   {
       return response()->json([
           'message' => 'Company updated successfully',
           'data' => new CompanyResource(
               $this->repository->createOrUpdate($request->all(), $company->id)
           ),
       ]);
   }
}
