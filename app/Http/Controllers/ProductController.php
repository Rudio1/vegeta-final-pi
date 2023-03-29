<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\modelProduct;
use App\Models\Product;


class ProductController extends Controller
{
    public function findById($id){
        try {
            $product = Product::find($id);

            return [
                $product->name,
                $product->price,
                $product->description,
                $product->product_image
            ];
        } catch (\Throwable $th) {
            return response()->json('Id informado não existe', 404);
        }
    }

    public function deleteProduct($id){
        try {
            $product = Product::find($id);
            $product->delete();

            return response()->json('Produto deletado!', 200);
        } catch (\Throwable $th) {
            return response()->json('Id informado não existe', 404);
        }
    }

    public function updateProduct(ProductRequest $request, $id){

    }

    public function createProduct(ProductRequest $request){
        
    }


}
