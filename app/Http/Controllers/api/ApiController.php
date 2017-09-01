<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

/**
 * Class ApiController
 * @package App\Http\Controllers\api
 */
class ApiController extends Controller
{
    /**
     * @var int
     */
    protected $stateCode=200;

    const CODE_WRONG_ARGS = 'GEN-FUBARGS';
    const CODE_NOT_FOUND = 'GEN-LIKETHEWIND';
    const CODE_INTERNAL_ERROR = 'GEN-AAAGGH';
    const CODE_UNAUTHORIZED = 'GEN-MAYBGTFO';
    const CODE_FORBIDDEN = 'GEN-GTFO';
    const CODE_INVALID_MIME_TYPE = 'GEN-UMWUT';

    /**
     * @var Manager
     */
    protected $fractal;

    /**
     * ApiController constructor.
     */
    function __construct()
    {
        $this->fractal=new Manager();
        if (isset($_GET['include'])){
            $this->fractal->parseIncludes($_GET['include']);
        }
    }

    /**
     * @return int
     */
    public function getStateCode()
    {
        return $this->stateCode;
    }


    /**
     * @param $stateCode
     * @return $this
     */
    public function setStateCode($stateCode)
    {
        $this->stateCode = $stateCode;
        return $this;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function noContent()
    {
        return response()->json(null,204);
    }

    /**
     * @param $item
     * @param $callback
     * @return mixed
     */
    public function responseWithItem($item, $callback)
    {
        $resource=new Item($item,$callback);
        $rootScope=$this->fractal->createData($resource);
        return $this->responseWithArray($rootScope->toArray());
    }

    /**
     * @param $collection
     * @param $callback
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseWithCollection($collection, $callback)
    {
        $resource=new Collection($collection,$callback);
        $rootScope=$this->fractal->createData($resource);
        return $this->responseWithArray($rootScope->toArray());
    }

    /**
     * @param $paginator
     * @param $callback
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseWithPaginator($paginator, $callback)
    {
        $resource=new Collection($paginator,$callback);
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));
        $rootScope=$this->fractal->creatData($resource);
        return $this->responseWithArray($rootScope->toArray());

    }

    /**
     * @param array $array
     * @param array $header
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseWithArray(array $array, array $header=[])
    {
        return response()->json($array,$this->stateCode,$header);
    }

    /**
     * @param $message
     * @param $errorCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseWithError($message, $errorCode)
    {
        if ($this->stateCode===200){
            trigger_error(
                'no error',
                E_USER_WARNING
            );
        }
        return $this->responseWithArray([

                'error'=>[
                    'code'=>$errorCode,
                    'http_code'=>$this->stateCode,
                    'message'=>$message
                ]
            ]);
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorForbidden($message = 'Forbidden')
    {
        return $this->setStateCode(500)
            ->responseWithError($message,static::CODE_FORBIDDEN);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function errorInternalError($message = 'Internal Error')
    {
        return $this->setStatusCode(500)
            ->respondWithError($message, self::CODE_INTERNAL_ERROR);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function errorNotFound($message = 'Resource Not Found')
    {
        return $this->setStatusCode(404)
            ->respondWithError($message, self::CODE_NOT_FOUND);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function errorUnauthorized($message = 'Unauthorized')
    {
        return $this->setStatusCode(401)
            ->respondWithError($message, self::CODE_UNAUTHORIZED);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function errorWrongArgs($message = 'Wrong Arguments')
    {
        return $this->setStatusCode(400)
            ->respondWithError($message, self::CODE_WRONG_ARGS);
    }
}
