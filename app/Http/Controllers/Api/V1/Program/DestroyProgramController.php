<?php

namespace App\Http\Controllers\Api\V1\Program;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Repositories\Contracts\ProgramRepositoryInterface;
use App\Traits\PaginateJsonResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DestroyProgramController extends Controller
{
    use PaginateJsonResponse;

    /**
     * @var ProgramRepositoryInterface
     */
    private ProgramRepositoryInterface $repository;

    /**
     * Instance Constructor.
     *
     * @param ProgramRepositoryInterface $repository
     */
    public function __construct(ProgramRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all videos.
     *
     * @param Request $request
     * @param Program $program
     * @return JsonResponse
     */
   public function __invoke(Request $request, Program $program): JsonResponse
   {
       return response()->json([
           'message' => 'Audits lists successfully',
           'data' => $this->repository->delete($program->id),
       ]);
   }
}
