<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Events\NewUserRegistered;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showAuthForm(){
        return view('auth.login');
    }

    public function register(Request $request){


      $data=User::create([
        'name'=> $request->name,
        'email'    =>   $request->email,
        'password' => Hash::make($request->password),
        // 'role_id'  => 3
      ]);
      event(new NewUserRegistered($data));
    //   dd($data);

    return redirect()->route('login')->with('success', 'Your account has been created!');    }

    public function storelogin(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Attempt to log the user in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('dashboard');
        }

        return redirect()->back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the session to prevent reuse
        $request->session()->invalidate();

        // Regenerate the session token to prevent CSRF attacks
        $request->session()->regenerateToken();

        // Redirect to the login page (or any other route)
        return redirect('/login');
    }
}
