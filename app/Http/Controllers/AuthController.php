<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DataBase\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(
        UserService $userService
        )
    {
        $this->userService = $userService;
    }

    public function showRegisterForm()
    {
        return view('auth/register'); // register.blade.phpを表示
    }

    public function showLoginForm()
    {
        return view('auth/login'); // login.blade.phpを表示
    }

    public function register(Request $request)
    {
        $this->userService->register($request->all());
        return redirect()->route('login');
    }

    public function login(Request $request)
    {


        Log::info(Auth::guard('web')->check());
        Log::info(Auth::guard('web')->user());

        if ($this->userService->login($request->all())) {
            return redirect()->route('view_main_thread_new');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
