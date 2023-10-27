<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($e->getPrevious() instanceof ModelNotFoundException) {
                $modelNotFoundEx = $e->getPrevious();
                $modelName = class_basename($modelNotFoundEx->getModel());
                $message = "There is no record for $modelName";

                if (count($modelNotFoundEx->getIds()) > 0) {
                    $message .= ' with id(s) ' . implode(', ', $modelNotFoundEx->getIds());
                } else {
                    $message .= '.';
                }
                return response()->json([
                    'message' => $message,
                ], 404);
            }
            // If the closure does not return a value, default exception rendering will be utilized
            // https://laravel.com/docs/10.x/errors#:~:text=.-,If,-the%20closure%20given
        });
    }
}
