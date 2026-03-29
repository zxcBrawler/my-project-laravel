<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Throwable;

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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof AuthorizationException) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => 'forbidden',
                    'message' => $exception->getMessage() ?: 'У вас недостаточно прав для выполнения этого действия',
                    'code' => 403
                ], 403);
            }
            
            return response()->view('errors.403', [
                'message' => $exception->getMessage() ?: 'У вас недостаточно прав для выполнения этого действия',
                'code' => 403
            ], 403);
        }

        if ($exception instanceof AuthenticationException) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => 'unauthenticated',
                    'message' => 'Необходимо авторизоваться',
                    'code' => 401
                ], 401);
            }
            
            return redirect()->route('login')
                ->with('error', 'Пожалуйста, войдите в систему для продолжения');
        }

        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => 'not_found',
                    'message' => 'Страница не найдена',
                    'code' => 404
                ], 404);
            }
            
            return response()->view('errors.404', [], 404);
        }

        if ($exception instanceof \ErrorException || $exception instanceof \Exception) {
            if (config('app.debug')) {
                return parent::render($request, $exception);
            }
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => 'server_error',
                    'message' => 'Внутренняя ошибка сервера',
                    'code' => 500
                ], 500);
            }
            
            return response()->view('errors.500', [], 500);
        }

        return parent::render($request, $exception);
    }
}