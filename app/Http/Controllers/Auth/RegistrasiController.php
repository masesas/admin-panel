<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Providers\RouteServiceProvider;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RegistrasiController extends Controller {

    public function index() {
        return view('auth.register');
    }


    public function store(Request $request) {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $email = $request->email;
        $password = $request->password;

        $userModel = UserModel::where('email', $email)->where('password', $password)->first();
        if (!empty($userModel)) {
            Session::put('user_login', $userModel);

            return redirect(RouteServiceProvider::HOME);
        }

        return back()->withErrors([
            'email' => 'Pastikan Email dan Password mu Benar',
        ])->onlyInput('email');
    }
}
