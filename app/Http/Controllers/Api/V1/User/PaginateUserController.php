<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserResource;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Traits\PaginateJsonResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaginateUserController extends Controller
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
     * Get all programs.
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
           'message' => 'Users lists successfully',
           'data' => $this->paginate($paginator, UserResource::class),
       ]);
   }
}
