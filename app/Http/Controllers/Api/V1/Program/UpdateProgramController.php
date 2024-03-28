<?php

namespace App\Http\Controllers\Api\V1\Program;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProgramRequest;
use App\Http\Resources\Api\ProgramResource;
use App\Models\Program;
use App\Repositories\Contracts\ProgramRepositoryInterface;
use App\Traits\PaginateJsonResponse;
use Illuminate\Http\JsonResponse;

class UpdateProgramController extends Controller
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
     * @param ProgramRequest $request
     * @param Program $program
     * @return JsonResponse
     */
   public function __invoke(ProgramRequest $request, Program $program): JsonResponse
   {
       return response()->json([
           'message' => 'Program updated successfully',
           'data' => new ProgramResource(
               $this->repository->createOrUpdate($request->all(), $program->id)
           ),
       ]);
   }
}
