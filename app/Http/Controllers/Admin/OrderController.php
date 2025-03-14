<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderedCartItem;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::with('user')->paginate(10);

        return view('admin.orders.index',compact('orders'));
    }

    public function edit(Order $order)
    {
        $orderedProducts = OrderedCartItem::with('product')->where('order_id',$order->id)->get();

        return view('admin.orders.edit',compact('order','orderedProducts'));
    }

    public function update(Order $order)
    {
        $order->update([
            'status' => request('status')
        ]);

        return redirect()->route('admin.orders.index')->with('success','Order updated successfully');
    }

    public function show(Order $order)
    {
        $orderedProducts = OrderedCartItem::with('product')->where('order_id',$order->id)->get();

        return view('admin.orders.show',compact('order','orderedProducts'));
    }

    public function destroy(Order $order)
    {
        $order->items()->each(function ($item) {
            $item->forceDelete();
        });

        $order->forceDelete();

        return redirect()->route('admin.orders.index')->with('success','Order deleted successfully');
    }
}
