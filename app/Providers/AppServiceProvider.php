<?php

namespace App\Providers;

use App\Repositories\News\NewsRepository;
use App\Repositories\News\NewsRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\NewsComment\NewsCommentRepositoryInterface;
use App\Repositories\NewsComment\NewsCommentRepository;

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
            UserRepositoryInterface::class, 
            UserRepository::class,
        );

        $this->app->bind(
          
            NewsRepositoryInterface::class,
            NewsRepository::class
        );
        
        $this->app->bind(
          
            NewsCommentRepositoryInterface::class,
            NewsCommentRepository::class
        );
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
