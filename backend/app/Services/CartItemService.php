<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Facades\Validator;
use App\Repositories\CartItemRepository;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;

class CartItemService extends BaseService
{

    /**
     * @var CartItemRepository
     */
    protected $cartItemRepository;


    /**
     * AuthRepository constructor.
     * @param CartItemRepository $cartItemRepository
     */
    public function __construct(CartItemRepository $cartItemRepository)
    {
        $this->cartItemRepository = $cartItemRepository;
    }

    public function getCartItem($id) {

        return $this->sendResponse($this->cartItemRepository->get($id), 'CartItems retrieved successfully.');
    }

    public function getCartItemList() {

        return $this->sendResponse($this->cartItemRepository->getAll(), 'CartItems retrieved successfully.');
    }

    public function createCartItem($request) 
    {
        $input = $request->all();
    
        $validator = Validator::make($input, [
            'product_id' => 'required',
            'quantity' => 'required',

        ]);

        $cart = Cart::firstOrCreate(['user_id' =>Auth::user()->id]);
        $input['cart_id'] = $cart->id;
        
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
     
        return $this->sendResponse($this->cartItemRepository->create($input), 'CartItem created successfully.');
   
    }

    public function UpdateCartItem($request) 
    {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;

        $cart = Cart::where('user_id',$input['user_id'])->first();

        return $this->sendResponse($this->cartItemRepository->update($input, $cart->id), 'CartItem updated successfully.');
   
    }
}
