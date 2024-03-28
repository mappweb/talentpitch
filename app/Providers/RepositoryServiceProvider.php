<?php

namespace App\Providers;

use App\Repositories\Contracts\ChallengeRepositoryInterface;
use App\Repositories\Contracts\ProgramRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\EloquentChallengeRepository;
use App\Repositories\EloquentProgramRepository;
use App\Repositories\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(ChallengeRepositoryInterface::class, EloquentChallengeRepository::class);
        $this->app->bind(ProgramRepositoryInterface::class, EloquentProgramRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
