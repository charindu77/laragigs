<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

class RegistrationController extends Controller
{
    public function __invoke(UserRequest $request)
    {
        $user=User::create($request->validated());

        auth()->login($user);

        return redirect('/')->with('success','User: '.$request->validated('name').' is created successfully and logged in');
    }
}
