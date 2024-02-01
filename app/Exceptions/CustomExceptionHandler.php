<?php

namespace App\Exceptions;

// use Illuminate\Routing\Exceptions\RouteNotFoundException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class CustomExceptionHandler extends Exception
{
    public function render($request, \Throwable $exception)
    {
        if ($exception instanceof RouteNotFoundException) {
            return response()->json([
                'error' => 'Route not found',
                'message' => 'The requested route could not be found.',
            ], 404);
        }

        return parent::render($request, $exception);
    }
}

