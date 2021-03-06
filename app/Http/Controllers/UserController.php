<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Validator;
use Auth;
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    public function getUser(Request $request)
    {
        if (Auth::check()) {
            return Auth::user()->name;
        }
    }

    public function register(Request $request)
    {
        $rules = array(
            'email' => 'required|email|max:191',
            'password' => 'required|string|max:191',
            'name' => 'required|string|max:191',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
        
            $token = $user->createToken($request->name . 'Sign up')->plainTextToken;
            return response()->json(
                [
                'status' => 200,
                'message' => "Sign up Successful",
                'token' => $token,
                'username' => $user->name
                ]
            );
        }
    }
    public function login(Request $request)
    {
        $rules = array(
            'email' => 'required|email|max:191',
            'password' => 'required|string|max:191',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                // Auth::login($user, true);// this logs in user and remembers the user
                $token = $user->createToken($user->name . 'Logs in')->plainTextToken;
                return response()->json(
                    [
                    'status' => 200,
                    'message' => "Login Successful",
                    'token' => $token,
                    'username' => $user->name
                    ]
                );
            } else {
                return [ "error" => "The provided credentials are incorrect!"];
            }
        }
    }
    public function logout(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            Auth::guard('web')->logout();
            $user->tokens()->delete();
            
            return response()->json(
                [
                'status' => 200,
                'message' => "Logout Successful"
                ]
            );
        }
    }
}
