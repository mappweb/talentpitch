<?php

namespace App\Http\Controllers\Api\V1\Company;

use App\Helpers\ChatGPTMock;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class MockCompanyController extends Controller
{
    /**
     * Display the specified challenge.
     *
     * @param Request $request
     * @return JsonResponse
     */
   public function __invoke(Request $request): JsonResponse
   {
       try {
           $items = ChatGPTMock::generate(
               prompt: "Companies",
               keys: [
                   "name",
                   "image_path",
                   "location",
                   "industry",
               ],
               count: 10
           );
       } catch (Throwable $exception) {
           $items = Company::factory()
               ->count(10)
               ->make()
               ->toArray();
       }
       foreach ($items as $item) {
           $company = new Company();
           $company->fill($item);
           $company->save();
       }

       return response()->json([
           'data' => $items,
       ]);
   }
}
