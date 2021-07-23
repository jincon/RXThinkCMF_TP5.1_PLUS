<?php

namespace app\http\middleware;

/**
 * 登录中间件
 * @author 牧羊人
 * @since 2021/2/1
 * Class CheckLogin
 * @package app\http\middleware
 */
class CheckLogin
{
    /**
     * 执行句柄
     * @param $request
     * @param \Closure $next
     * @author 牧羊人
     * @since 2021/2/1
     */
    public function handle($request, \Closure $next)
    {
        // 登录校验
        if (!in_array(request()->controller(), ['Login'], false)) {
            if (empty(session('adminId'))) {
                // 跳转至登录页面
                return redirect("/login/index");
            }
        }
        return $next($request);
    }
}
