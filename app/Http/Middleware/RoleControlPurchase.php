<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleControlPurchase
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
        $user = Auth::user();
        if ($user->role != 3){
            $viewData = [
                'user' => $user,
                'title' => '提示信息',
                'message' => '您不属于采购部门, 没有访问该页面的权限',
                'url' => url('/home'),
                'url_message' => '返回'
            ];
            return response()->view('CommitSuccessfully', $viewData);
        }
        return $next($request);
    }
}
