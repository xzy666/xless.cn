<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Manager;
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
}
