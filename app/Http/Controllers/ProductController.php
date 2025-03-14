<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productShow($slug)
    {
        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            abort(404);
        }
        return view('frontend.product.product-view', compact('product'));
    }

    public function products(Request $request)
    {
        $categories = Category::where('status', 'active')->get();

        $query = Product::where('status', 'active');

        if ($request->has('categories')) {
            $query->whereIn('category_id', $request->categories);
        }

        $products = $query->paginate(12)->appends($request->query());

        return view('frontend.products', compact('categories', 'products'));
    }

    public function addToCart(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please log in to add products to your cart.');
        }

        $product = Product::findOrFail($request->product_id);
        $user = auth()->user();

        $cartItem = CartItem::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            CartItem::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'price' => $product->price,
                'quantity' => 1
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function cartUpdate(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:cart_items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::where('id', $request->id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json(['success' => true, 'message' => 'Cart updated successfully!']);
    }


    public function viewCart()
    {
        $cartItems = CartItem::where('user_id', auth()->id())->get();

        return view('frontend.product.cartview', compact('cartItems'));
    }

    public function removeFromCart($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();

        return redirect()->back()->with('success', 'Product removed from cart!');
    }

    public function checkout()
    {
        $cartItems = CartItem::where('user_id', auth()->id())->get();
        $customer = Customer::where('user_id', auth()->id())->first();

        return view('frontend.product.checkout', compact('cartItems','customer'));
    }

    public function processCheckout(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:10',
            'country' => 'required|string|max:255',
        ]);

        $cartItems = CartItem::where('user_id', auth()->id())->get();
        $totalQuantity = $cartItems->sum('quantity');
        $grandTotal = $cartItems->sum(fn($item) => $item->price * $item->quantity);

        $customerData = array_merge($validatedData, [
            'user_id' => auth()->id(),
        ]);
       Customer::updateOrCreate(['user_id' => auth()->id()], $customerData);

        $orderData = [
            'user_id' => auth()->id(),
            'status' => 'pending',
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'order_date' => now(),
            'quantity' => $totalQuantity,
            'total_amount' => $grandTotal,
        ];
        $order = Order::create($orderData);

        $cartItems->each(function ($cartItem) use ($order) {
            \App\Models\OrderedCartItem::create([
                'order_id'   => $order->id,
                'user_id'    => $cartItem->user_id,
                'product_id' => $cartItem->product_id,
                'price'      => $cartItem->price,
                'quantity'   => $cartItem->quantity,
            ]);

            $cartItem->delete();
        });


        return redirect()->route('success', ['order_number' => $order->order_number]);
    }
    public function success(Request $request)
    {
        $orderNumber = $request->input('order_number');
        return view('frontend.product.success', compact('orderNumber'));
    }

    public function orders()
    {
        $orders = Order::where('user_id', auth()->id())->latest()->get();

        return view('frontend.product.orders', compact('orders'));
    }

}
