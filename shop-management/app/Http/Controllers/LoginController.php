<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function validateLogin(Request $request)
    {
        $user = User::where('user_name', $request->user_name)
                    ->where('password', $request->password)->first();

        if($user)
        {
            if($user->designation == 'admin')
                return view('admin_dashboard');
            else
                return view('seller_dashboard');
        }
        else
            return redirect()->back()->with('err', 'Username or Password wrong.');
    }
}
