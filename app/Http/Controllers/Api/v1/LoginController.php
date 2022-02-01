<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required']        
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();                       
            return [
                'user'=>$user,               
                'status'=>true
            ];
        }else{
            return [
                'status'=>false
            ];
        }

        return back()->withErrors([
            'name' => 'The provided credentials do not match our records.',
        ]);
    }
    public function protectionUser (Request $request){
        $user = Auth::user();
        if ($user){
            return [
                'user'=>$user,
                'status' => true
            ];
        }else{
            return[
                'status' => false
            ];
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
