<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\User;
use App\Mail\ForgotPasswordMail;
use Mail;
use Str;

class AuthController extends Controller
{
    public function login()
    {
        if(!empty(Auth::check()))
        {
            if(Auth::user()->user_type == 1)
            {
                return redirect('admin/dashboard');
            }
            elseif(Auth::user()->user_type == 2)
            {
                return redirect('teacher/dashboard');
            }
            elseif(Auth::user()->user_type == 3)
            {
                return redirect('student/dashboard');
            }
            elseif(Auth::user()->user_type == 4)
            {
                return redirect('parent/dashboard');
            }
        }
        return view('auth.login');
    }

    public function AuthLogin(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember))
        {
            if(Auth::user()->user_type == 1)
            {
                return redirect('admin/dashboard');
            }
            elseif(Auth::user()->user_type == 2)
            {
                return redirect('teacher/dashboard');
            }
            elseif(Auth::user()->user_type == 3)
            {
                return redirect('student/dashboard');
            }
            elseif(Auth::user()->user_type == 4)
            {
                return redirect('parent/dashboard');
            }
        }
        else
        {
            return redirect()->back()->with('error', "Please enter currect email and password.");
        }
    }

    public function forgot_password()
    {
        return view('auth.forgot');
    }

    public function post_forgot_password(Request $request)
    {
        $user = User::getEmailSingle($request->email);
        if(!empty($user))
        {
            $user->remember_token = Str::random(30);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            return redirect()->back()->with('success', "Please check your email and reset your password!");
        }
        else
        {
            return redirect()->back()->with('error', "Email not found!");
        }
    }

    public function reset_password($remember_token)
    {
        $user = User::getTokenSingle($remember_token);
        if(!empty($user))
        {
            $data['user'] = $user;
            return view('auth.reset', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function post_reset_password($remember_token, Request $request)
    {
        if($request->password == $request->cpassword)
        {
            $user = User::getTokenSingle($remember_token);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();

            return redirect(url(''))->with('success', "Password successfully reset");
        }
        else
        {
            return redirect()->back()->with('error', "Password and confirm passowrd does not match");
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(url(''));
    }
}