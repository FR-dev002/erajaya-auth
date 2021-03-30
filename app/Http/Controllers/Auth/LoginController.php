<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function Login()
    {
        return view('login');
    }

    protected function goTo($role)
    {
        if ($role == "admin") {
            return 'admin';
        } elseif ($role == "user") {
            return 'user';
        }
    }

    /**
     * Action Login
     * NOTE Semua validasi dilakukan di LoginRequest,
     */
    public function login_action(LoginRequest $request)
    {
        $user = $request->getUserModel();
        Auth::login($user);
        $role = $user->getRole();
        return redirect($this->goTo($role));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
