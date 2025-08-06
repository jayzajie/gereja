<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Mail;
use App\Mail\Transport\BrevoApiTransport;

class BrevoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Mail::extend('brevo', function (array $config) {
            return new BrevoApiTransport(
                $config['api_key'] ?? config('services.brevo.api_key'),
                $this->app['events'],
                $this->app['log']
            );
        });
    }
}
