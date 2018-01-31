<?php
namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;

trait ExceptionTrait
{

  function apiException($request,$e){
    if ($this->isModel($e)) {
      return response([
        'errors'=>'Product Model not found'
      ],Response::HTTP_NOT_FOUND);
    }

    if ($this->isHttp($e)) {
      return response([
        'errors'=>'Route not found'
      ],Response::HTTP_NOT_FOUND);
    }

    return parent::render($request, $e);
  }

  public function isModel($e){
    return $e instanceof ModelNotFoundException;
  }

  public function isHttp($e){
    return $e instanceof NotFoundHttpException;
  }
}
