<?php

namespace App\Http\Middleware;

use App\Models\SessionKeyModel;
use Closure;
use Illuminate\Http\Request;

class Auth {
    public function handle(Request $request, Closure $next) {
        $userSession = session()->get(SessionKeyModel::USER_LOGIN);
        $isLogin = !empty($userSession);

        view()->share('userSession', $userSession);
        view()->share('isLogin', $isLogin);

        return $next($request);
    }
}
