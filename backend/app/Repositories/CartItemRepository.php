<?php

namespace App\Repositories;
use App\Models\CartItem;

class CartItemRepository 
{
    

    public function getAll() {
        
        return CartItem::all();
    }

    public function get($id) {
        
        return  CartItem::with('product')->findOrFail($id);
    }

    public function create($input) {
        
        return CartItem::create($input);
    }

    public function update($input, $cart_id) {
        unset($input['user_id']);
        return CartItem::where(['cart_id'=>$cart_id,'product_id'=>$input['product_id']])->update($input);
    }

}
