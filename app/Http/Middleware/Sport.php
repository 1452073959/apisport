<?php

namespace App\Http\Middleware;

use Closure;

class Sport
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

        if (!$request->has('token')) {
//            dd($request);
            return response()->json([
                'code' => '400',
                'msg' => '请先登录'
            ]);
        }
//        dump(date('Y-m-d H:i:s', time()));
//        return $next($request);
        return $next($request);
    }
}
