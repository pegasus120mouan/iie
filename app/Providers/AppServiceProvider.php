<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
            config([
                'session.secure' => env('SESSION_SECURE_COOKIE', true),
                'session.encrypt' => env('SESSION_ENCRYPT', true),
            ]);
        }

        Password::defaults(function () {
            return Password::min(10)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols();
        });

        RateLimiter::for('login', function (Request $request) {
            $key = strtolower($request->input('email', '')).'|'.$request->ip();

            return [
                Limit::perMinute(5)->by($key),
                Limit::perHour(20)->by($request->ip()),
            ];
        });

        RateLimiter::for('forms', function (Request $request) {
            return Limit::perMinute(8)->by($request->ip());
        });

        RateLimiter::for('api', function (Request $request) {
            $token = $request->bearerToken() ?? $request->header('X-API-Token') ?? 'anonymous';

            return Limit::perMinute(60)->by($token.'|'.$request->ip());
        });
    }
}
