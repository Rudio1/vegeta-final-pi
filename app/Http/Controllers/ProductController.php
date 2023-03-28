<?php

namespace App\Http\Controllers;

use App\Models\modelProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function findById($id){
        $models = modelProduct::join('products', 'models.id', '=', 'products.model_id')
        ->select('models.name')
        ->get();

        foreach ($models as $model ) {
            $modelName = $model['name']; 
        }
        try {
            $product = Product::find($id);

            return [
                $product->name,
                $product->price,
                $modelName,
                $product->description
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
}
