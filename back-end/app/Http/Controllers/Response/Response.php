<?php

namespace App\Http\Controllers\Response;

use Illuminate\Support\Arr;
use PhpParser\Node\Expr\Cast\Object_;

trait Response
{

    protected $AMOUNT_PAGINATE = 10;

    private $responseSuccess = [
        'message' => 'Process completed successfully!',
        'type'    => 'success'
    ];

    private $responseError = [
        'message' => 'There was an error in the process!',
        'type'    => 'error'
    ];

    private $responseException = [
        'message' => 'There was an exception error',
        'type'    => 'Exception'
    ];

    public function success($status = 200, $options = [])
    {
        if (!empty($options)) {
           $response = $this->fillResponseWithNewParams($this->responseSuccess, $options);
        }

        return response()->json($response, $status);
    }

    public function error($status = 500, $options = [])
    {
        if (!empty($options)) {
           $response = $this->fillResponseWithNewParams($this->responseError, $options);
        }

        return response()->json($response, $status);
    }

    public function Exception($status = 500, $options = [])
    {
        if (!empty($options)) {
           $response = $this->fillResponseWithNewParams($this->response, $options);
        }

        return response()->json($response, $status);
    }

    public function paginate($object, int $page) 
    {
        return $object->paginate(
            $this->AMOUNT_PAGINATE, ['*'], 'page', $page);
    }

    private function fillResponseWithNewParams(array $response, array $newParams): array
    {
        foreach($newParams as $key => $value) {
            $response[$key] = $value;
        }

        return $response;
    }
}