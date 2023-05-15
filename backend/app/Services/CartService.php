<?php

namespace App\Services;


use Illuminate\Support\Facades\Validator;
use App\Repositories\CartRepository;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;

class CartService extends BaseService
{

    /**
     * @var CartRepository
     */
    protected $cartRepository;


    /**
     * AuthRepository constructor.
     * @param CartRepository $cartRepository
     */
    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function getCart($id) {

        return $this->sendResponse($this->cartRepository->get($id), 'Carts retrieved successfully.');
    }

    public function getCartList() {

        return $this->sendResponse($this->cartRepository->getAll(), 'Carts retrieved successfully.');
    }

    public function createCart($request) 
    {
        $input = $request->all();
     
        $validator = Validator::make($input, [
            'user_id' => 'required',

        ]);
     
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
     
        return $this->sendResponse($this->cartRepository->create($input), 'Cart created successfully.');
   
    }

    public function UpdateCart($request, $cart) 
    {
        $input = $request->all();
     
        $validator = Validator::make($input, [
            'user_id' => 'required',
        ]);
     
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
     
        return $this->sendResponse($this->cartRepository->update($input, $cart), 'Cart updated successfully.');
   
    }

    public function getUserCart($request) 
    {

        $input = $request->all();
        $input['user_id'] =Auth::user()->id;
        return $this->sendResponse($this->cartRepository->getCartByUserId($input['user_id']), 'Carts retrieved successfully.');
   
    }

    public function resetUserCart() 
    {
        
        return $this->sendResponse($this->cartRepository->resetCart(Auth::user()->id), 'Cart reset successfully.');
   
    }
}
