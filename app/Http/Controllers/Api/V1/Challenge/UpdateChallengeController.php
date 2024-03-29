<?php

namespace App\Http\Controllers\Api\V1\Challenge;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChallengeRequest;
use App\Http\Resources\Api\ChallengeResource;
use App\Models\Challenge;
use App\Repositories\Contracts\ChallengeRepositoryInterface;
use App\Traits\PaginateJsonResponse;
use Illuminate\Http\JsonResponse;

class UpdateChallengeController extends Controller
{
    use PaginateJsonResponse;

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
     * Update the specified challenge in storage.
     *
     * @param ChallengeRequest $request
     * @param Challenge $challenge
     * @return JsonResponse
     */
   public function __invoke(ChallengeRequest $request, Challenge $challenge): JsonResponse
   {
       return response()->json([
           'message' => 'Challenge created successfully',
           'data' => new ChallengeResource(
               $this->repository->createOrUpdate($request->all(), $challenge->id)
           ),
       ]);
   }
}
