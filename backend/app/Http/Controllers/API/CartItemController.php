<?php
     
namespace App\Http\Controllers\API;
     
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Models\CartItem;
use App\Services\CartItemService;
     
class CartItemController extends Controller
{
    
    /**
     * @var CartItemService
     */
    protected $cartItemService;


    /**
     * CartItemService constructor.
     * @param CartItemService $authRepository
     */

    public function __construct(CartItemService $cartItemService)
    {
        $this->cartItemService = $cartItemService;
    }

    public function index()
    {
        return $this->cartItemService->getCartItemList();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->cartItemService->createCartItem($request);

    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->cartItemService->getCartItem($id);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
       return $this->cartItemService->UpdateCartItem($request);
        
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CartItem $cartItem)
    {
        $cartItem->delete();
     
        return $this->sendResponse([], 'CartItem deleted successfully.');
    }
}