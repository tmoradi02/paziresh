<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {   
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        
        $user = User::where('email', $request->email)->first();

        if($user->status != 1)
        {
            return redirect()->route('login')
            ->with('error','حساب کاربری شما تایید نشده است');
        }
        // dd('li');
        auth()->attempt(['email' => $request->email, 'password' => $request->password]);

        // if($user->email != $request->email)
        // {
        //     return redirect()->route('login')
        //     ->with('error','نام کاربری شما نادرست می باشد');
        // }

        if($user->password != $request->password)
        {
            return redirect()->route('login')
            ->with('error','کلمه عبور شما نادرست می باشد');
        }

        return redirect()->route('home');
    }
}

