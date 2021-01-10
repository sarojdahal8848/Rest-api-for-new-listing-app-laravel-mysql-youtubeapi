<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Facade\FlareClient\Http\Response;

class AuthController extends Controller
{
    public function register(Request $request){
        $validatedData = $request->validate([
            'name'=>'required|string|max:100',
            'email'=>'email|required|unique:users',
            'password'=>'required|confirmed|max:20|min:6'
        ]);
        $validatedData['password']=bcrypt($validatedData['password']);
        $user = User::create($validatedData);
        $token = $user->createToken('token')->accessToken;
        $response = ['token'=>$token,'user'=>$user];
        return Response($response,200);
    }

    public function login(Request $request){
        $loginData = $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        // if(!auth()->Auth::attempt($loginData)){
        //     return Response(['error'=>'invalide credential']);
        // }

        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('token')->accessToken;
                $response = ['token' => $token,'user'=> $user];
                return response($response, 200);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }

    }

    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
}
