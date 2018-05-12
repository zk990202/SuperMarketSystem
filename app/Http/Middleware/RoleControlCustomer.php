<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleControlCustomer
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
        if ($user->role != 4){
            $viewData = [
                'user' => $user,
                'title' => '提示信息',
                'message' => '您不是顾客, 没有访问该页面的权限',
                'url' => url('/home'),
                'url_message' => '返回'
            ];
            return response()->view('CommitSuccessfully', $viewData);
        }
        return $next($request);
    }
}
