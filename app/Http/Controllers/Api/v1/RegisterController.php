<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $validator=Validator::make(
            $request -> all(),
            [
                'name' => ['required', 'string', 'max:255', 'unique:users'],                
                'password' => ['required', 'string', 'min:8'],
            ]
        );
        if($validator->fails()){
            return [
                'status '=> false,
                'error' => $validator -> messages()
            ];
        };

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return [
            'status'=>true
        ];
    }
}
