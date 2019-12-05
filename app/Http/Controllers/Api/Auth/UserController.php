<?php

namespace App\Http\Controllers\Api\Auth;

use JWTAuth;
use App\User;
use JWTAuthException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\Api\Controller;

class UserController extends Controller
{
    public function getToken($email, $password)
    {
      $token = null;
      try {
        if(!$token = JWTAuth::attempt( ['email'=>$email, 'password'=>$password])){
          return response()->json([
              'response' => 'error',
              'message' => 'Password or email is invalid',
              'token'=>$token
          ]);
        }
      } catch (JWTAuthException $e) {
        return response()->json([
            'response' => 'error',
            'message' => 'Token creation failed',
        ]);
      }
      return $token;
    }

    // Refresh auth token
    public function refresh() 
    {
      try {
        $newToken = auth()->refresh();
      } catch(\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
        return response()->json([
          'error' => $e->getMessage()
        ], 401);
      }
      return response()->json(['token' => $newToken ]);
    }

    public function login(Request $request)
    {
      $data = $request->only(['email', 'password']);
      //$token = auth()->attempt($data);
      if(!$token = auth()->attempt($data)) {
        return response()->json(['error' => 'Invalid email/password.'], 401);
      }
      $user = [
        'id' => auth()->user()->id,
        'name' => auth()->user()->name,
        'email' => auth()->user()->email,
      ];
      return response()->json([
        'user' => $user,
        'success' => true,
        'token' => $token
      ], 200);
    }

    public function logout() {
      try {
        auth()->logout();
      } catch(\Tymon\JWTAuth\Exceptions\JWTException $e){
        return response()->json([
          'status' => 'Error',
          'message' => $e->getMessage()
      ], 401);
      }
      return response()->json([
          'status' => 'success',
          'message' => 'Thank you.'
      ], 200);
    }

    public function register(Request $request)
    {
      $data = [
        'name' => $request->name,
        'email' => $request->email,
        'password' => \Hash::make($request->password)
      ];
      $validate = $request->validate([
          'name' => 'required',
          'email' => 'required|email|unique:users',
          'password' => 'required'
      ]);
      //dd($validate);
      $user = new User($data);
      if($user->save()) {
        $token = self::getToken($request->email, $request->password); // generate user token
        if (!is_string($token))  return response()->json(['success'=>false,'data'=>'Token generation failed'], 201);
        $user = \App\User::where('email', $request->email)->get()->first();
        // $user->auth_token = $token; // update user token
        $user->save();
        $response = [
            'success'=>true, 
            'data'=>['name'=>$user->name,'id'=>$user->id,'email'=>$request->email,'auth_token'=>$token]
        ]; 
      } else {
        $response = [
            'success'=>false, 
            'data'=>'Couldnt register user'
        ];
      }
      return response()->json($response, 201);
    }

    public function getCurrentUser() 
    {
        if(Auth::check()){

            $user = Auth::user();
            if(!$user){
                return response()->json(['message', 'User not found'], 400);
            }
        return response()->json(['user', $user], 200);
        }
        
    }


    
}

