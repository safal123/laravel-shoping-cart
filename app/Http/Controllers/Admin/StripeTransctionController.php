<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe;

class StripeTransctionController extends Controller
{
    public function index()
    {
        $stripe = Stripe::make(env('STRIPE_SECRET'), '2018-02-28');
        $charges = Stripe::charges()->all()['data'];
        // dd($charges);
        $balance = $stripe->balance()->current();
        $amount = $balance['available'][0]['amount'];
        return view('admin.transctions.index', compact('charges', 'amount'));
    }

    public function show($id)
    {
        $stripe = Stripe::make(env('STRIPE_SECRET'), '2018-02-28');
        $charge = $stripe->charges()->find($id);
        // dd($stripe->customers()->all());
        return view('admin.transctions.show', compact('charge'));
    }

    public function refund(Request $request)
    {
        $stripe = Stripe::make(env('STRIPE_SECRET'), '2018-02-28');
        $refund = $stripe->refunds()->create($request->charge);
        return redirect()->route('admin.stripe.transctions');
    }
}
