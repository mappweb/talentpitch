<?php

namespace App\Http\Controllers\Api\V1\Challenge;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChallengeRequest;
use App\Http\Resources\Api\ChallengeResource;
use App\Repositories\Contracts\ChallengeRepositoryInterface;
use Illuminate\Http\JsonResponse;

class CreateChallengeController extends Controller
{
    /**
     * @var ChallengeRepositoryInterface
     */
    private ChallengeRepositoryInterface $repository;

    /**
     * Instance Constructor.
     *
     * @param ChallengeRepositoryInterface $repository
     */
    public function __construct(ChallengeRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a challenge resource.
     *
     * @param ChallengeRequest $request
     * @return JsonResponse
     */
   public function __invoke(ChallengeRequest $request): JsonResponse
   {
       return response()->json([
           'message' => 'Challenge created successfully',
           'data' => new ChallengeResource($this->repository->createOrUpdate($request->all())),
       ]);
   }
}
