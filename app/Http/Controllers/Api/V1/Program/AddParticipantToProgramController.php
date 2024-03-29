<?php

namespace App\Http\Controllers\Api\V1\Program;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use App\Models\Company;
use App\Models\Program;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AddParticipantToProgramController extends Controller
{
    /**
     * Update the specified program in storage.
     *
     * @param Request $request
     * @param Program $program
     * @return JsonResponse
     */
    public function __invoke(Request $request, Program $program): JsonResponse
    {
        $option = $request->get('type', 'user');
        /**
         * @var Model $modelType
         */
        $modelType = match ($option) {
            'user' => User::class,
            'company' => Company::class,
            'challenge' => Challenge::class
        };
        $entity = $modelType::query()
            ->findOrFail($request->get('participant_id'));
        $function = (Str::plural($option));
        if (!method_exists($program, $function)) {
            throw new \DomainException('Participant no found');
        }
        $program->{$function}()
            ->detach($entity);
        $program->{$function}()->attach(
            $entity,
            [
                'id' => Str::uuid(),
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        return response()->json([
            'message' => 'Participant added successfully',
            'data' => $entity->toArray(),
        ]);
    }
}
