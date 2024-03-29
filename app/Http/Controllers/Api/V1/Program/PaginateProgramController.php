<?php

namespace App\Http\Controllers\Api\V1\Program;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProgramResource;
use App\Repositories\Contracts\ProgramRepositoryInterface;
use App\Traits\PaginateJsonResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaginateProgramController extends Controller
{
    use PaginateJsonResponse;

    /**
     * @var ProgramRepositoryInterface
     */
    private ProgramRepositoryInterface $repository;

    /**
     * Instance Constructor.
     *
     * @param ProgramRepositoryInterface $repository
     */
    public function __construct(ProgramRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of programs
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
           'message' => 'Programs lists successfully',
           'data' => $this->paginate($paginator, ProgramResource::class),
       ]);
   }
}
