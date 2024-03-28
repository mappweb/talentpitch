<?php

namespace App\Http\Controllers\Api\V1\Challenge;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use App\Repositories\Contracts\ChallengeRepositoryInterface;
use App\Traits\PaginateJsonResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DestroyChallengeController extends Controller
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
     * Get all videos.
     *
     * @param Request $request
     * @return JsonResponse
     */
   public function __invoke(Request $request, Challenge $challenge): JsonResponse
   {
       return response()->json([
           'message' => 'Audits lists successfully',
           'data' => $this->repository->delete($challenge->id),
       ]);
   }
}
