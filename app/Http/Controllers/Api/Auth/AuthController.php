<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;

use App\User;
use JWTAuth;

class AuthController extends Controller
{
    public $token = true;

    public function register(Request $request){
        $validated = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        if($validated->fails()){
            return response()->json(['error' => $validated->errors()], 401);
        }

        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->save();

        if($this->token){
            return $this->login($request);
        }

        return response()->json(['success' => true, 'user' => $user], 200);
    }

    public function login(Request $request){
        $validated = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if($validated->fails()){
            return response()->json(['error' => $validated->errors()], 400);
        }

        $input = $request->only('email', 'password');
        $jwt_token = null;

        if(!$jwt_token = JWTAuth::attempt($input)){
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'token' => $jwt_token
        ]);

    }

    public function logout(Request $request){
        $validated = Validator::make($request->all(), [
            'token' => 'required'
        ]);

        if($validated->fails()){
            return response()->json(['error' => $validated->errors()], 401);
        }

        try{
            JWT::invalidate($request->token);
            return response()->json([
                'success' => true,
                'message' => 'User has logged out successfully'
            ]);
        }catch(JWTException $e){
            return response()->json([
                'error' => $e,
                'message' => 'Internal Server Error'
            ], 500);
        }
    }

    public function getUser(Request $request){
        $validated = Validator::make($request->all(), [
            'token' => 'required',
        ]);

        $user = JWTAuth::authenticate($request->token);
        return response()->json(['user' => $user], 200);
    }
}
