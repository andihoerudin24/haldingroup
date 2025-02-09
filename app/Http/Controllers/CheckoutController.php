<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $sessionId = session()->getId();
        $cartItems = CartItem::getCartItemsForSession($sessionId);
        $cartCount = CartItem::getCartItemCountForSession(session()->getId());
        $cartSubtotal = CartItem::getCartSubtotalForSession($sessionId);
        return view('checkout', compact('cartItems', 'cartCount', 'cartSubtotal'));
    }


    public function process()
    {
        $sessionId = session()->getId();
        $orderId = Order::createOrderForSession($sessionId);
        if ($orderId) {
            $order =DB::table('orders')->where('id', $orderId)->first();
            session()->flush();
            return redirect()->route('index')
                ->with('success', 'Checkout successful. Order Number: ' . $order->order_number);
        } else {
            return redirect()->back()->with('error', 'Checkout failed.');
        }
    }
}
