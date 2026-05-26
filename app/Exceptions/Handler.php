<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        // Handle 404 errors
        if ($e instanceof NotFoundHttpException) {
            if ($request->is('admin/*')) {
                return response()->view('errors.admin.404', [], 404);
            }
            return response()->view('errors.front.404', [], 404);
        }

        // Handle 500 errors
        if ($this->isHttpException($e) && $e->getStatusCode() === 500) {
            if ($request->is('admin/*')) {
                return response()->view('errors.admin.500', [], 500);
            }
            return response()->view('errors.front.500', [], 500);
        }

        return parent::render($request, $e);
    }
}
