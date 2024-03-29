<?php

namespace App\Http\Controllers\Api\V1\Challenge;

use App\Helpers\ChatGPTMock;
use App\Http\Controllers\Controller;
use App\Models\Challenge;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class MockChallengeController extends Controller
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
               prompt: "Proposed challenges for written tests",
               keys: [
                   "title",
                   "description",
                   "difficulty",
               ],
               count: 10
           );
       } catch (Throwable $exception) {
           $items = Challenge::factory()
               ->count(10)
               ->make()
               ->toArray();
       }
       foreach ($items as $item) {
           $challenge = new Challenge();
           $challenge->fill($item);
           $challenge->save();
       }

       return response()->json([
           'data' => $items,
       ]);
   }
}
