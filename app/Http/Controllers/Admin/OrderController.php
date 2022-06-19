<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $this->authorize('create');

        $orders = Order::select('id', 'email', 'subtotal', 'placed_at', 'packaged_at', 'shipped_at')->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    public function destroy(Order $order)
    {
        $order->delete();
        
        return redirect()->route('admin.orders.index', compact('order'))->with('danger', 'Order deleted successfuly!');
    }
}
