<?php

namespace App\Exceptions;

use Exception;

class ErrorValidation extends Exception
{
  public $message;
  public $code;
  public $res;

  public function __construct($message = "Ok", $code = "200", $res = null)
  {
    $this->message = $message;
    $this->code = $code;
    $this->res = $res;
  }

  public function render()
  {
    return [
      "response" => $this->res,
      "metadata" => [
        "message" => $this->message,
        "code" => $this->code
      ]
    ];
  }
}
