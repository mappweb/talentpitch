<?php

namespace App\Http\Controllers\Api\V1\Company;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CompanyResource;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShowCompanyController extends Controller
{
    /**
     * Display the specified company.
     *
     * @param Request $request
     * @param Company $company
     * @return JsonResponse
     */
   public function __invoke(Request $request, Company $company): JsonResponse
   {
       return response()->json([
           'message' => 'Program find successfully',
           'data' => new CompanyResource($company),
       ]);
   }
}
