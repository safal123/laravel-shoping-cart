<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe;

class HomeController extends Controller
{
  public function index()
  {
    // $stripe = Stripe::charges()->all();
    // dd($stripe);
    return view('admin.index');
  }
}
