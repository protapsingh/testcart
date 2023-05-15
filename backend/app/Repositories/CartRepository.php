<?php

namespace App\Repositories;
use App\Models\Cart;

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

}
