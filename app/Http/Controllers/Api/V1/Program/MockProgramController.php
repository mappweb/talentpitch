<?php

namespace App\Http\Controllers\Api\V1\Program;

use App\Helpers\ChatGPTMock;
use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class MockProgramController extends Controller
{
    /**
     * Display the specified challenge.
     *
     * @param Request $request
     * @return JsonResponse
     */
   public function __invoke(Request $request): JsonResponse
   {
       try {
           $items = ChatGPTMock::generate(
               prompt: "Study courses",
               keys: [
                   "title",
                   "description",
                   "start_date:Y-m-d",
                   "end_date:Y-m-d",
               ],
               count: 10
           );
       } catch (Throwable $exception) {
           $items = Program::factory()
               ->count(10)
               ->make()
               ->toArray();
       }
       foreach ($items as $item) {
           $program = new Program();
           $program->fill($item);
           $program->save();
       }

       return response()->json([
           'data' => $items,
       ]);
   }
}
