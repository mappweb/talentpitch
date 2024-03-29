<?php

namespace Tests\Unit;

use App\Helpers\ChatGPTMock;
use DomainException;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class ChatGPTMockTest extends TestCase
{
    use WithFaker;

    /**
     * A basic test example.
     */
    public function test_chatgtp_mock_generate_domain_exception_response(): void
    {
        $this->expectException(DomainException::class);

        Config::set('app.openai_api_key', $this->faker->password);
        ChatGPTMock::generate(
            $this->faker->sentence,
            [
                $this->faker->randomKey,
                $this->faker->randomKey
            ],
            $this->faker->randomDigit()
        );
    }
}
