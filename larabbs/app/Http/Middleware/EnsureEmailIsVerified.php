<?php

namespace App\Http\Middleware;

use Closure;

class EnsureEmailIsVerified
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
        //三个判断：
        //1.如果用户已经登录
        //2.并且还未认证Email
        //3.并且访问的不是email验证相关url或者退出url。
        if($request->user() &&
            ! $request->user()->hasVerifiedEmail()&&
                !$request->is('email/*','logout')){
            return $request->expectsJson()
                        ? abort(403,'your email address is not verified')
                        : redirect()->route('verification.notice');
        }
        return $next($request);
    }
}
