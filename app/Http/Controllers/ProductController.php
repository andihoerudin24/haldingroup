<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\CartItem;
use App\Models\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::getAllProducts();
        $cartCount = CartItem::getCartItemCountForSession(session()->getId());
        return view('index', compact('products', 'cartCount'));
    }

    public function show($id)
    {
        $product = Product::getProductDetail($id);
        return view('show', compact('product'));
    }

    public function add(CartRequest $request, $productId)
    {
        Product::addToCart($productId, $request->quantity);
        return redirect()->route('index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }
}
