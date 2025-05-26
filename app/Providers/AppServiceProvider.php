<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::shouldBeStrict(!app()->isProduction());

        Response::macro('success', function ($data) {
            return response()->json(["data" => $data]);
        });

        Response::macro('created', function ($data) {
            return response()->json(["data" => $data], 201);
        });

        Response::macro('error', function ($message, $statusCode = 400) {
            return response()->json(["message" => $message], $statusCode);
        });

        Response::macro("noContent", function () {
            return response()->noContent();
        });
    }
}
