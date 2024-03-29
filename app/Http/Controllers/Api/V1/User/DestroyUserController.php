<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Traits\PaginateJsonResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DestroyUserController extends Controller
{
    use PaginateJsonResponse;

    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $repository;

    /**
     * Instance Constructor.
     *
     * @param UserRepositoryInterface $repository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all videos.
     *
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
   public function __invoke(Request $request, User $user): JsonResponse
   {
       return response()->json([
           'message' => 'User deleted successfully',
           'data' => $this->repository->delete($user->id),
       ]);
   }
}
