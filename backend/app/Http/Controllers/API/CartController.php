<?php
     
namespace App\Http\Controllers\API;
     
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Models\Cart;
use App\Services\CartService;
     
class CartController extends Controller
{
    
    /**
     * @var CartService
     */
    protected $cartService;


    /**
     * CartService constructor.
     * @param CartService $authRepository
     */

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        return $this->cartService->getCartList();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->cartService->createCart($request);

    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->cartService->getCart($id);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        return $this->cartService->UpdateCart($request, $cart);
        
    }

    public function getUserCart(Request $request)
    {   
        return $this->cartService->getUserCart($request);
    }
   

    public function resetCart()
    {
        return $this->cartService->resetUserCart();
    }


      /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Cart $cart)
    {
        $cart->delete();
     
        return $this->sendResponse([], 'Cart deleted successfully.');
    }

}