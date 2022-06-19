<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderConfirmationController extends Controller
{
    public function __invoke(Order $order)
    {
        return view('frontend.orders.confirmation', compact('order'));
    }
}
