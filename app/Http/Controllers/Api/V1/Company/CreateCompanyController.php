<?php

namespace App\Http\Controllers\Api\V1\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Resources\Api\CompanyResource;
use App\Repositories\Contracts\CompanyRepositoryInterface;
use Illuminate\Http\JsonResponse;

class CreateCompanyController extends Controller
{
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
     * Create a challenge resource.
     *
     * @param CompanyRequest $request
     * @return JsonResponse
     */
   public function __invoke(CompanyRequest $request): JsonResponse
   {
       return response()->json([
           'message' => 'Company created successfully',
           'data' => new CompanyResource($this->repository->createOrUpdate($request->all())),
       ]);
   }
}
