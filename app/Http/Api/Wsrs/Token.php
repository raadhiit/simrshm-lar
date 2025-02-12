<?php

namespace App\Http\Controllers\Api\Wsrs;

use App\Http\Controllers\Controller;
use App\Models\TokenAntrean;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Token extends Controller
{
  const TOKEN           = "RS_BPJS_INOVASI_IDE_UTAMA";
  const TOKEN_USERNAME  = "user-dummy";
  const TOKEN_PASSWORD  = "pass-dummy";

  public function index(Request $request) {
    $username = $request->header("x-username");
    $password = $request->header("x-password");

    $user = TokenAntrean::where(["username" => $username, "password" => $password])->first();
    if(!is_null($user)) {
      $date = Carbon::now();
      $data = str_shuffle(self::TOKEN).$date->format('Y-m-d h:i:s');
      $user->token = hash("sha256", $data);
      $user->expired = $date->addHour();
      $user->save();

      $token = [
        "token" => $user->token
      ];
      $message = "Ok";
      $code = "200";
    } else {
      $token = null;
      $message = "Username atau password salah.";
      $code = "201";
    }

    return [
      "response" => $token,
      "metadata" => [
        "message" => $message,
        "code" => $code
      ]
    ];
  }
}
