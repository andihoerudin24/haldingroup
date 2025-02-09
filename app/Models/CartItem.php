<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CartItem extends Model
{
    protected $table = 'cart_items';

    protected $fillable = ['session_id', 'product_id', 'quantity'];

    public static function getCartItemCountForSession($sessionId)
    {
        return DB::table('cart_items')
            ->where('session_id', $sessionId)
            ->sum('quantity');
    }

    public static function getCartItemsForSession($sessionId)
    {
        return DB::table('cart_items')
            ->join('products', 'cart_items.product_id', '=', 'products.id')
            ->select('cart_items.*', 'products.name', 'products.price', 'products.image')
            ->where('cart_items.session_id', $sessionId)
            ->get();
    }

    public static function getCartSubtotalForSession($sessionId)
    {
        return DB::table('cart_items')
            ->join('products', 'cart_items.product_id', '=', 'products.id')
            ->where('cart_items.session_id', $sessionId)
            ->sum(DB::raw('products.price * cart_items.quantity'));
    }

    public static function updateItemQuantity($cartItemId, $quantity)
    {
        $sessionId = session()->getId();
        $affected = DB::table('cart_items')
            ->where('id', $cartItemId)
            ->where('session_id', $sessionId)
            ->update([
                'quantity'   => $quantity,
                'updated_at' => now(),
            ]);

        if ($affected) {
            return DB::table('cart_items')
                ->where('id', $cartItemId)
                ->where('session_id', $sessionId)
                ->first();
        }

        return null;
    }

    public static function deleteItem($cartItemId)
    {
        $sessionId = session()->getId();
        return DB::table('cart_items')
            ->where('id', $cartItemId)
            ->where('session_id', $sessionId)
            ->delete();
    }

}
