<?php
/*
|--------------------------------------------------------------------------
| Created by www.aa96.me ~ AbdulKader Aliwi
| eng.aliwi@gmail.com
|--------------------------------------------------------------------------
*/
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    public function authenticated()
    {
        if (session('link') != null) {
            return redirect(session('link'));
        } else {
            return redirect()->route('home');
        }
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        flash('Email or password is wrong')->error();
        return back();
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect()->route('home');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
