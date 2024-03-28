<?php

namespace App\Http\Controllers\Api\V1\Challenge;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ChallengeResource;
use App\Models\Challenge;
use App\Repositories\Contracts\ChallengeRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShowChallengeController extends Controller
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
     * Find video.
     *
     * @param Request $request
     * @param Challenge $challenge
     * @return JsonResponse
     */
   public function __invoke(Request $request, Challenge $challenge): JsonResponse
   {
       return response()->json([
           'message' => 'Challenge find successfully',
           'data' => new ChallengeResource($challenge),
       ]);
   }
}
