<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\EloquentRepositoryInterface;

use App\Repositories\User\UserInterface;
use App\Repositories\User\UserRepository;

use App\Repositories\Role\RoleInterface;
use App\Repositories\Role\RoleRepository;


use App\Repositories\RoleUser\RoleUserInterface;
use App\Repositories\RoleUser\RoleUserRepository;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(RoleInterface::class, RoleRepository::class);
        $this->app->bind(RoleUserInterface::class, RoleUserRepository::class);
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
