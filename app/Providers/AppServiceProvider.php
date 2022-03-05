<?php

namespace App\Providers;

use App\Repositories\User\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\User\UserRepository',
            EloquentUserRepository::class

        );


//        $class = new \App\Logic\UserService(app('App\Repositories\User\UserRepository'));


        $this->app->bind('UserService',function (){
            return new \App\Logic\UserService(app('App\Repositories\User\UserRepository'));
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
