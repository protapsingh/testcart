<?php
   
namespace App\Http\Controllers\API;  
use App\Services\AuthService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

   
class AuthController extends Controller
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */

    protected $authService;

    public function __construct(AuthService $authService)
    {

     $this->authService = $authService;

    }

    public function register(Request $request)
    {
        return $this->authService->createUser($request);
   
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        return $this->authService->userLogin($request);
    }
}