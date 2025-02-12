<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\Api\Wsrs\Token;
use App\Models\TokenAntrean;
use Carbon\Carbon;

class AuthWsrs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $xtoken = $request->header("x-token");
        $xusername = $request->header("x-username");
        $user = TokenAntrean::where(["username" => $xusername, "token" => $xtoken])->first();

        if(is_null($user)) {
            // jika token dan username salah
            return response()->json([
                "metadata" => [
                    "message" => "Token tidak sesuai.",
                    "code" => 201
                ]
            ]);
        } else if(Carbon::now() > $user->expired) {
            // jika expired
            return response()->json([
                "metadata" => [
                    "message" => "Token expired.",
                    "code" => 201
                ]
            ]);
        }
        return $next($request);
    }
}
