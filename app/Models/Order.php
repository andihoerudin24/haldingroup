<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Order extends Model
{
    protected $fillable = ['user_id', 'order_number', 'total', 'status'];

    public static function createOrderForSession($sessionId)
    {
        $cartItems = DB::table('cart_items')
            ->join('products', 'cart_items.product_id', '=', 'products.id')
            ->select('cart_items.*', 'products.price')
            ->where('cart_items.session_id', $sessionId)
            ->get();
        if ($cartItems->isEmpty()) {
            return null;
        }

        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->price * $item->quantity;
        }

        $orderNumber = strtoupper(Str::random(10));
        DB::beginTransaction();
        try {
            $orderId = DB::table('orders')->insertGetId([
                'session_id'   => $sessionId,
                'order_number' => $orderNumber,
                'total'        => $total,
                'status'       => 'pending',
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);

            foreach ($cartItems as $item) {
                DB::table('order_items')->insert([
                    'order_id'   => $orderId,
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->price,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::table('cart_items')->where('session_id', $sessionId)->delete();

            DB::commit();

            return $orderId;
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return null;
        }
    }

}
