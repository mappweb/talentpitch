<?php

namespace App\Http\Controllers\Api\V1\Program;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProgramRequest;
use App\Http\Resources\Api\ProgramResource;
use App\Repositories\Contracts\ProgramRepositoryInterface;
use Illuminate\Http\JsonResponse;

class CreateProgramController extends Controller
{
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
     * Create a challenge resource.
     *
     * @param ProgramRequest $request
     * @return JsonResponse
     */
   public function __invoke(ProgramRequest $request): JsonResponse
   {
       return response()->json([
           'message' => 'Program created successfully',
           'data' => new ProgramResource($this->repository->createOrUpdate($request->all())),
       ]);
   }
}
