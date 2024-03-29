<?php

namespace App\Http\Controllers\Api\V1\Challenge;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ChallengeResource;
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
     * Remove the specified challenge from storage.
     *
     * @param Request $request
     * @param Challenge $challenge
     * @return JsonResponse
     */
   public function __invoke(Request $request, Challenge $challenge): JsonResponse
   {
       $deleted = $this->repository->delete($challenge->id);

       return response()->json([
           'message' => $deleted ? 'Challenge deleted successfully' : 'Challenge could not be eliminated',
           'data' => new ChallengeResource($challenge),
       ]);
   }
}
