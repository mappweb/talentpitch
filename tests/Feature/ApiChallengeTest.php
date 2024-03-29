<?php

namespace Tests\Feature;

//use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Challenge;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ApiChallengeTest extends TestCase
{
    use WithFaker;

    /**
     * @var string|\Laravel\Sanctum\string
     */
    protected string $token;
    protected Challenge $model;
    protected string $baseUrl = '/api/v1/challenges';

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        DB::beginTransaction();
        $email = $this->faker->safeEmail();
        $password = "password";
        /**
         * @var User $user
         */
        $user = User::factory(
            [
                'first_name' => $this->faker->firstName(),
                'last_name' => $this->faker->lastName(),
                'email' => $email,
                'password' => Hash::make($password),
            ]
        )->create();
        $this->token = $user->createToken('ApiToken')
            ->plainTextToken;
        $this->model = Challenge::factory()
            ->create();
    }

    /**
     * Get all resources.
     *
     * @return void
     */
    public function test_get_all_challenges_successful_response()
    {
        $response = $this->get($this->baseUrl, [
            'Authorization' => 'Bearer ' . $this->token,
            'perPage' => 10,
            'page' => 1,
        ]);

        $response->assertStatus(200);
    }

    /**
     * Get specified resource by id
     *
     * @return void
     */
    public function test_get_challenge_by_id_successful_response()
    {
        $response = $this->get($this->baseUrl . DIRECTORY_SEPARATOR . $this->model->id,
            [
                'Authorization' => 'Bearer ' . $this->token,
            ]);

        $response->assertStatus(200);
    }

    /**
     * Get specified resource by id
     *
     * @return void
     */
    public function test_get_challenge_by_id_not_found_exception_response()
    {
        $response = $this->get($this->baseUrl . DIRECTORY_SEPARATOR . $this->faker->uuid,
            [
                'Authorization' => 'Bearer ' . $this->token,
            ]);

        $response->assertStatus(404);
    }

    /**
     * Create resource
     *
     * @return void
     */
    public function test_create_challenge_validation_exception_response()
    {
        $response = $this->post($this->baseUrl,
            [
                'title' => $this->faker->name,
                'description' => $this->faker->paragraph,
            ],
            [
                'Authorization' => 'Bearer ' . $this->token,
            ]
        );

        $response->assertStatus(422);
    }

    /**
     * @return void
     */
    protected function tearDown(): void
    {
        DB::rollBack();
    }

}