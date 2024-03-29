<?php

namespace App\Http\Controllers\Api\V1\Program;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProgramResource;
use App\Models\Program;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShowProgramController extends Controller
{
    /**
     * Display the specified program.
     *
     * @param Request $request
     * @param Program $program
     * @return JsonResponse
     */
   public function __invoke(Request $request, Program $program): JsonResponse
   {
       return response()->json([
           'message' => 'Program find successfully',
           'data' => new ProgramResource($program),
       ]);
   }
}
