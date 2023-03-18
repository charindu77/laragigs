<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthUserRequest;

class AuthenticationController extends Controller
{
    public function __invoke(AuthUserRequest $request)
    {
        if(auth()->attempt($request->validated())){
            $request->session()->regenerate();

            return redirect()->intended()->with('success', 'Welcome ' . auth()->user()->name);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match',
        ])->onlyInput('email');
    }
}
