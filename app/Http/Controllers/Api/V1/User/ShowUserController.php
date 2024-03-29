<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProgramResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShowUserController extends Controller
{
    /**
     * Display the specified user.
     *
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
   public function __invoke(Request $request, User $user): JsonResponse
   {
       return response()->json([
           'message' => 'User find successfully',
           'data' => new ProgramResource($user),
       ]);
   }
}
