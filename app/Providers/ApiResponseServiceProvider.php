<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ApiResponseServiceProvider extends ServiceProvider
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
         // success responses
         Response::macro('success', function ($data) {
            return Response::json($data, 200);
        });

        Response::macro('created', function ($data) {
            return Response::json($data, 201);
        });

        Response::macro('updated', function () {
            return Response::json(null, 204);
        });

        Response::macro('deleted', function () {
            return Response::json(null, 204);
        });

        Response::macro('logout', function () {
            return Response::json(null, 204);
        });

        // Success but has nothing to return
        Response::macro('noContent', function () {
            return Response::json(null, 204);
        });


        // Bad request (something wrong with URL or parameters)
        Response::macro('badRequest', function ($error) {
            return Response::json(['message' => $error], 400);
        });

        // Not authorized (not logged in)
        Response::macro('unauthorized', function () {
            return Response::json(['message' => 'Unauthenticated.'], 401);
        });

        // Logged in but access to requested area is forbidden
        Response::macro('forbidden', function ($error) {
            return Response::json(['message' => $error], 403);
        });

        // Not Found (page or other resource doesn't exist)
        Response::macro('notFound', function ($error) {
            return Response::json(['message' => $error], 404);
        });

        /**  
         * The server understands the content type of the request entity, and the syntax of the request entity is correct,
         * but it was unable to process the contained instructions
         * e.g. validation errors
         */
        Response::macro('unprocessableEntity', function ($error) {
            return Response::json(['message' => $error], 422);
        });


        // General server error
        Response::macro('serverError', function ($error) {
            return Response::json(['message' => $error], 500);
        });
    }
}
