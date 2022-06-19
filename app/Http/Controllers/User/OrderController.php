<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __invoke()
    {
        $orders = Order::where('email', auth()->user()->email)->latest()->get();
        $orders->load(['attributes.product', 'attributes.stocks']);

        return view('user.orders.index', compact('orders'));
    }
}
