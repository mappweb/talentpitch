<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\Api\UserResource;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Traits\PaginateJsonResponse;
use Illuminate\Http\JsonResponse;

class UpdateUserController extends Controller
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
     * Update the specified user in storage.
     *
     * @param UserRequest $request
     * @param User $user
     * @return JsonResponse
     */
   public function __invoke(UserRequest $request, User $user): JsonResponse
   {
       return response()->json([
           'message' => 'User updated successfully',
           'data' => new UserResource(
               $this->repository->createOrUpdate($request->all(), $user->id)
           ),
       ]);
   }
}
