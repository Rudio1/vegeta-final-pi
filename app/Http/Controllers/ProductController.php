<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\ProductRequest;
use Intervention\Image\Facades\Image;
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
            return response()->json('Id informado não existe', 422);
        }
    }

    public function deleteProduct($id){
        try {
            $product = Product::find($id);
            $product->delete();

            return response()->json('Produto deletado!', 200);
        } catch (\Throwable $th) {
            return response()->json('Id informado não existe', 422);
        }
    }

    public function updateProduct(ProductRequest $request, $id){
        $product = Product::findOrFail($id);

        if(!$product){
            return response()->json('Id invalido', 422);
        }

        $product->name = $request->input('name') ?: $product->name;
        $product->price = $request->input('price') ?: $product->price;
        $product->description = $request->input('description') ?: $product->description;
        $product->product_image = $request->input('product_image') ?: $product->product_image;
        
        $product->save();
        return response()->json('Produto atualizado com sucesso', 200);


    }

    public function createProduct(ProductRequest $request){

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $filename = explode('.', $request->file('product_image')->getClientOriginalName())[0];
            $path = public_path('images/' . $filename);
            Image::make($image->getRealPath())->save($path);
        }
        
        try {
            // $product = ProductRequest::create([
            //     'name' => $request->name,
            // ]);

        } catch (\Throwable $th) {
            return response()->json('Não foi possivel adicionar o produto', 414);
        }
        



    }


}
