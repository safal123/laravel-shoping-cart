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
        try {
            if (! $token = JWTAuth::parseToken()) {
                return response()->json('Something went wrong.');
            }
            $charge = Stripe::charges()->create([
                'amount' => 10,
                'currency' => 'AUD',
                'source' => $request->id,
                'description' => 'Order',
                'receipt_email' => 'pokharelsafal66@gmail.com',
                'metadata' => [
                ],
            ]);
            return response()->json("Success");
        } catch (CardErrorException $e) {
            return response()->json($e);
        }
    }
}
