<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{


    public function showFormLogin()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {

        $user = $request->only('email', 'password');


        if (Auth::attempt($user)) {
            $check_khoa = Auth::user();
            if ($check_khoa->is_active == 0) {
                Auth::logout();
                return redirect()->back()->with('error', 'tài khoản đã bị khóa');
            }
            return redirect()->intended('/');
        }
        return redirect()->back()->with('Email', 'sai địa chỉ email');
    }

    public function showFormRegister(Request $request)
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        $user = User::query()->create($data);
        Auth::login($user);
        return redirect()->intended('/');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');

    }
}
