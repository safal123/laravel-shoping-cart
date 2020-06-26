<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();

        return view('admin.orders.index', compact('orders', $orders));
    }

    public function show(Order $order)
    {
        $order = Order::where('id', $order->id)->first();

        return view('admin.orders.show', compact('order', $order));
    }
}
