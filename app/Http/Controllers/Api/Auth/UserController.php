<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class UserController extends Controller
{
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
        'token' => $token
        ]);
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
}
