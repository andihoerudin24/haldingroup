<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $sessionId = session()->getId();
        $cartItems = CartItem::getCartItemsForSession($sessionId);
        $cartCount = CartItem::getCartItemCountForSession(session()->getId());
        $cartSubtotal = CartItem::getCartSubtotalForSession($sessionId);
        return view('cartindex', compact('cartItems', 'cartCount', 'cartSubtotal'));
    }

    public function update(CartRequest $request, $cartItemId)
    {
        $updatedItem = CartItem::updateItemQuantity($cartItemId, $request->quantity);

        if ($updatedItem) {
            return response()->json(['success' => true, 'quantity' => $updatedItem->quantity]);
        }

        return response()->json(['success' => false], 400);
    }

    public function destroy($cartItemId)
    {
        $deleted = CartItem::deleteItem($cartItemId);
        if ($deleted) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 400);
    }

}
