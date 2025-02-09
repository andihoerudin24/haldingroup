<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name', 'description', 'price', 'stock', 'image'];

    public static function getAllProducts()
    {
        return DB::table('products')
            ->orderBy('name', 'asc')
            ->get();
    }

    public static function getProductDetail($id)
    {
        return DB::table('products')
            ->where('id', $id)
            ->first();
    }

    public static function addToCart($productId, $quantity)
    {
        $userId = session()->getId();
        $item = DB::table('cart_items')->where('product_id', $productId)
            ->where('session_id', $userId)
            ->first();
        if ($item) {
            DB::table('cart_items')
            ->where('id', $item->id)
            ->update([
                'quantity'   => $item->quantity + $quantity,
                'updated_at' => now(),
            ]);
            return $item;
       }

        return DB::table('cart_items')->insert([
            'session_id'    => $userId,
            'product_id' => $productId,
            'quantity'   => $quantity,
        ]);
    }
}

