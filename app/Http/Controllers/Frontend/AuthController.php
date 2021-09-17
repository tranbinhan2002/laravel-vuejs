<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request){
        $this->validate($request, [
            'phone' => 'required |regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'password' => 'required| min:6| confirmed',
            'password_confirmation' => 'required_with:password|same:password'
        ]);
        User::create([
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);
    }
    public function login(Request $request){
       $this->validate($request,[
           'phone'=> 'required |regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
           'password' => ['required']
       ]);
       if(Auth::attempt($request->only('phone','password'))){
           return response()->json(Auth::user(),200);
       }
       throw ValidationException::withMessages([
           'phone' => ['The provided credentials are incorrect.']
       ]);
    }

    public function logout() {
        Auth::logout();
    }
}
