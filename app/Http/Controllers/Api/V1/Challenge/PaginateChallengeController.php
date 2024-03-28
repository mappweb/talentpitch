<?php

namespace App\Http\Controllers\Api\V1\Challenge;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ChallengeResource;
use App\Repositories\Contracts\ChallengeRepositoryInterface;
use App\Traits\PaginateJsonResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaginateChallengeController extends Controller
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
     * Get all challenges.
     *
     * @param Request $request
     * @return JsonResponse
     */
   public function __invoke(Request $request): JsonResponse
   {
       $paginator = $this->repository->paginate(
           $request->get('perPage', 10),
           ['*'],
           'page',
           $request->get('page', 1),
       );

       return response()->json([
           'message' => 'Challenges lists successfully',
           'data' => $this->paginate($paginator, ChallengeResource::class),
       ]);
   }
}
