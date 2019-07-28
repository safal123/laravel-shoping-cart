<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class LoginController extends Controller
{
    public function login(Request $request)
    {
      $data = $request->only(['email', 'password']);
      
      //$token = auth()->attempt($data);

      if(!$token = auth()->attempt($data)) {
        return response()->json(['error' => 'Invalid email/password'], 401);
      }

      return response()->json(['token' => $token]);
    }
}
