<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PayMe;
use App\Contracts\PaymentGateway;

class CourseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
      
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
       
    }
}
