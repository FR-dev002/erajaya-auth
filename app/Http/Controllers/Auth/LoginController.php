<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function Login()
    {
        return view('login');
    }

    // protected function goTo()
    // {
    //     $role = Auth::user()->role;
    //     if ($role == "ADMIN") {
    //         return 'siswa';
    //     } elseif ($role == "GURU") {
    //         return 'soal';
    //     } else {
    //         return 'ujian_siswa';
    //     }
    // }

    // /**
    //  * Action Login
    //  * NOTE Semua validasi dilakukan di LoginRequest,
    //  */
    // public function login_action(LoginRequest $request)
    // {
    //     $user = $request->getUserModel();
    //     Auth::login($user);
    //     return redirect($this->goTo());
    // }

    // public function logout()
    // {
    //     Auth::logout();
    //     return redirect('/');
    // }
}
