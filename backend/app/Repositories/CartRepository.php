<?php

namespace App\Repositories;
use App\Models\Cart;
use App\Models\CartItem;

class CartRepository 
{
    public function getAll() {
        
        return Cart::all();
    }

    public function get($id) {
        
        return  Cart::with('cartUser','cartItems')->findOrFail($id);
    }

    public function create($input) {
        
        return Cart::create($input);
    }

    public function update($input, $cart) {
        
        $cart->user_id = $input['user_id'];
        return $cart->save();
    }

    public function getCartByUserId($userId) {
        
        return  Cart::with('cartItems.product')->where('user_id', $userId)->first();
    }

    public function resetCart($userId) {
        
        $cart = Cart::where('user_id', $userId)->first();
        CartItem::where('cart_id',$cart->id)->delete();
        return $cart->delete();
    }

}
