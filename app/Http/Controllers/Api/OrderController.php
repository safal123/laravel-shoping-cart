<?php

namespace App\Http\Controllers\Api;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class OrderController extends Controller
{
    public function index()
    {
      $user = Auth::user();
      if($user) {

        $orders = $user->orders;

        return response()->json([
          'orders' => $orders
        ], 200);

      } else{

        return response()->json([
          'message' => 'Something went wrong, please try again later.'
        ], 401);
      }
      
    }
}
