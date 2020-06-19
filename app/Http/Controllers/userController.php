<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function postSignUp(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'piratename' => 'required|max:120',
            'password' => 'required|min:4'
        ]);

        $email = $request['email'];
        $piratename = $request['piratename'];
        $password = bcrypt($request['password']);

        $user = new User();
        $user->email = $email;
        $user->piratename = $piratename;
        $user->password = $password;

        $user->save();

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function postSignIn(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']]))
        {
            return redirect()->route('dashboard');
        }

        return redirect()->back();
    }

    public function postLogout()
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
