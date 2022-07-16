<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{

    //register:function 

    public function register()
    {
        return view('auth.register');
    }
    public function handleRegister(Request $req)
    {
        $req->validate([
            'name'=>'required|string|max:100',
            'email'=>'required|email|max:100|unique:users',
            'password'=>'required|string|max:50|min:5'
        ]);
        $user = User::create([
            'name'=>$req->name,
            'email'=>$req->email,
            'password'=>  Hash::make($req->password) 
        ]);

        //login
        Auth::login($user);
        return redirect(route('books.index'));
    }

    //login:function
    public function login()
    {
        return view('auth.login');
    }
    public function handleLogin(Request $req)
    {
        $req->validate([
            'email'=>'required|email|max:100',
            'password'=>'required|string|max:50|min:5'
        ]);
        $is_login = Auth::attempt(['email'=>$req->email,'password'=>$req->password]);
        if(! $is_login)
        {
            return back();
        }
        return redirect(route('books.index'));
    }

    //logout:function
    public function logout()
    {
        Auth::logout();
        return redirect(route('auth.login'));
    }

    //github function 

    public function redirectToProvider () {
        return Socialite::driver('github')->redirect();
    }
    public function handleProviderCallback () {
        $user = Socialite::driver('github')->user();
        $email = $user->email;
        $db_user = User::where('email','=',$email)->first();
        if($db_user == null)
        {
            $registerd_user = User::create([
                'name'=> $user->name ?? $user->nickname,
                'email'=> $user->email,
                'password'=> Hash::make('1234'),
                'oauth_token'=>$user->token
            ]);
            Auth::login($registerd_user);
        }
        else{
            Auth::login($db_user);
        }

        return redirect( route('books.index'));
        // $user->token
    }
}
