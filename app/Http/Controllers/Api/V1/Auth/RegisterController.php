<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserResource;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
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
     * Handle a login request to the application.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $validator = $this->requestValidate($request);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Error',
                'data' => $validator->errors(),
            ], 423);
        }

        return response()->json([
            'message' => 'User created successfully',
            'user' => new UserResource($this->create($request->all())),
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return User
     */
    private function create(array $data): User
    {
        return $this->repository->createOrUpdate([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            $this->username() => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Validate the user login request.
     *
     * @param Request $request
     * @return \Illuminate\Validation\Validator
     */
    private function requestValidate(Request $request)
    {
        return Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            $this->username() => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    private function username(): string
    {
        return 'email';
    }
}
