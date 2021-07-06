<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Controllers\Controller;
use App\Services\ProductService;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;


class ProductApiController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService){
       $this->productService = $productService;
    }

    public function productsByTenant(TenantFormRequest $request){
         $products = $this->productService->getProductsByTenantUuid(
                    $request->token_company,
                    $request->get('categories', [])
                );

         return ProductResource::collection($products);
    }

    public function show(TenantFormRequest $request, $flag){
        if(!$product = $this->productService->getProductByFlag($flag)){
            return response()->json(['message' => 'Product Not Found'], 404);
        }

        return new ProductResource($product);
   }


}
