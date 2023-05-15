<?php

namespace App\Services;


use Illuminate\Support\Facades\Validator;
use App\Repositories\ProductRepository;
use App\Services\BaseService;
class ProductService extends BaseService
{

    /**
     * @var ProductRepository
     */
    protected $productRepository;


    /**
     * AuthRepository constructor.
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getProduct($id) {

        return $this->sendResponse($this->productRepository->get($id), 'Products retrieved successfully.');
    }

    public function getProductList() {

        return $this->sendResponse($this->productRepository->getAll(), 'Products retrieved successfully.');
    }

    public function createProduct($request) 
    {
        $input = $request->all();
     
        $validator = Validator::make($input, [
            'name' => 'required',
            'price' => 'required',
            'detail' => 'required',
            'stock' => 'required',
        ]);
     
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
     
        return $this->sendResponse($this->productRepository->create($input), 'Product created successfully.');
   
    }

    public function UpdateProduct($request, $product) 
    {
        $input = $request->all();
     
        $validator = Validator::make($input, [
            'name' => 'required',
            'price' => 'required',
            'detail' => 'required'
        ]);
     
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
     
        return $this->sendResponse($this->productRepository->update($input, $product), 'Product updated successfully.');
   
    }
}
