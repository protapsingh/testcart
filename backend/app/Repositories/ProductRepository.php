<?php

namespace App\Repositories;
use App\Models\Product;

class ProductRepository 
{
    

    public function getAll() {
        
        return Product::all();
    }

    public function get($id) {
        
        return  Product::findOrFail($id);
    }

    public function create($input) {
        
        return Product::create($input);
    }

    public function update($input, $product) {
        
        $product->name = $input['name'];
        $product->price = $input['price'];
        $product->detail = $input['detail'];
        $product->detail = $input['stock'];
        return $product->save();
    }

}
