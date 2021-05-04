<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe;

class StripeTransctionController extends Controller
{
    public function index()
    {
        $charges = Stripe::charges()->all()['data'];
        // dd($charges);
        return view('admin.transctions.index', compact('charges'));
    }

    public function show($id)
    {
        $charge = Stripe::charges()->retrieve($id, []);
        dd($charge);
    }
}
