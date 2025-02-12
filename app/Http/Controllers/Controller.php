<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    function responseFormat($message = "Ok", $code = "200", $res = null){
      return [
        "response" => $res,
        "metadata" => [
          "message" => $message,
          "code" => $code
        ]
      ];
    }
}
