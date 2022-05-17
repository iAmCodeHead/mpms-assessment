<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Arr;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;
use UnexpectedValueException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {

        if ($e instanceof ValidationException) {

            return response()->json(['status' => false, 'data' => $request->input(), 'message' => Arr::flatten($e->errors())[0]], 422);

        }

        if ($e instanceof AuthenticationException) {

            return response()->json(['status' => false, 'error' => $e->getMessage()], 401);

        }

        if ($e instanceof ModelNotFoundException) {

            return response()->json(['status' => false, 'error' => 'Entry for '.str_replace('App\\', '', $e->getModel()).' not found'], 404);

        }

        if($e instanceof UnexpectedValueException) {

            return response()->json(['status' => false, 'error' => $e->getMessage()], 400);

        }

        return response()->json(['status' => false, 'error' => $e->getMessage()], 500);

    }
}
