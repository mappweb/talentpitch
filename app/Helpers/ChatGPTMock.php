<?php

namespace App\Helpers;

use DomainException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Testing\Exceptions\InvalidArgumentException;

class ChatGPTMock
{
    /**
     * Get mock data for resources.
     *
     * @param string $prompt
     * @param array $keys
     * @param int $count
     * @param string $model
     * @param bool $cache
     * @return array
     */
    public static function generate(
        string $prompt,
        array  $keys,
        int    $count = 1,
        string $model = 'gpt-3.5-turbo',
        bool   $cache = true
    ): array
    {
        $implodedKeys = implode(', ', $keys);
        $signature = md5($prompt . $count . $implodedKeys . $model);
        if($cache && Cache::has($signature)){
            return Cache::get($signature);
        }

        $openAiKey = env('OPENAI_API_KEY');
        if (!$openAiKey) {
            throw new InvalidArgumentException(
                <<<EOT
                    OpenAI key not set. Please set the OPENAI_API_KEY environment variable.
                 EOT
            );
        }
        $request = Http::withHeaders([
            'Authorization' => "Bearer {$openAiKey}",
            "Content-Type" => "application/json"
        ])->post(
            'https://api.openai.com/v1/chat/completions', [
                'model' => $model,
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => <<< EOT
                            Hello, please help me by acting as a JSON response generator API simulator.
                            I will give you a prompt that the user entered that describes the data he wants,
                            and then the keys that the data should have. Your response should only be the JSON,
                            and must not contain any text before or after (such as: Below is your data).
                            The prompt is: {$prompt}. The keys are: {$implodedKeys}.
                            The number of entries that the JSON should have is: {$count}.
                        EOT,
                        'temperature' => 0.7
                    ]
                ]
            ]
        );
        if($request->clientError()){
            throw new DomainException(json_decode($request->body(), true)['error']['message']);
        }
        $chatGptRequest = $request->json();
        $response = json_decode($chatGptRequest['choices'][0]['message']['content'] ?? '', true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new DomainException('Error decoding the response');
        }
        Cache::put($signature, $response);

        return $response;
    }
}
