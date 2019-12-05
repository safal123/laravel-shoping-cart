<?php

namespace App\Http\Controllers\Api;

use Stripe;
use JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class StripeCheckoutController extends Controller
{
    public function checkout(Request $request) 
    {   
        //dd($request->token['id']);
        try {
            if (! $token = JWTAuth::parseToken()) {
                return response()->json('Something went wrong.');
            }
            $charge = Stripe::charges()->create([
                'amount' => $request->data['amount'],
                'currency' => 'AUD',
                'source' => $request->token['id'],
                'description' => 'Order',
                'receipt_email' => 'pokharelsafal66@gmail.com',
                'metadata' => [
                ],
            ]);
            return response()->json("Thanks for shoping with us.");
        } catch (CardErrorException $e) {
            return response()->json($e);
        }
    }
}
