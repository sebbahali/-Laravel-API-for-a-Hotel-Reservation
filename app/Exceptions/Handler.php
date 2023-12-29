<?php

namespace App\Exceptions;

use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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

    public function render($request , Throwable $e)
    {
            if($e instanceof ModelNotFoundException){
              
                $class = match ($e->getModel()){

                    Hotel::class => 'Hotel' ,
                    Room::class => 'Room' ,
                  default     => 'Record'
                };

                return response()->json(['message'=> $class .' not found']);
            }
            return parent::render($request ,$e);
    }


}
