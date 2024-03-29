<?php

namespace App\Http\Controllers\Api\V1\Company;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CompanyResource;
use App\Models\Company;
use App\Repositories\Contracts\CompanyRepositoryInterface;
use App\Traits\PaginateJsonResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DestroyCompanyController extends Controller
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
     * Remove the specified company from storage.
     *
     * @param Request $request
     * @param Company $company
     * @return JsonResponse
     */
   public function __invoke(Request $request, Company $company): JsonResponse
   {
       $deleted = $this->repository->delete($company->id);

       return response()->json([
           'message' => $deleted ? 'Company deleted successfully' : 'Company could not be eliminated',
           'data' => new CompanyResource($company),
       ]);
   }
}
