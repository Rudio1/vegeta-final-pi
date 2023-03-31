<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\PutProduct;
use Intervention\Image\Facades\Image;
use App\Models\Product;


class ProductController extends Controller
{
    public function getAllProduct(){
        try {
            $products = Product::all();
            return response()->json($products);
        } catch (\Throwable $th) {
            return response()->json('false', 422);
        }
    }

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

    public function updateProduct(PutProduct $request, $id){

        if($request->all() == []){
            return response()->json('Informe ao menos um campo à ser atualizado', 422);
        }
        try {
            $product = Product::findOrFail($id);
            $product->name = $request->input('name') ?: $product->name;
            $product->price = $request->input('price') ?: $product->price;
            $product->description = $request->input('description') ?: $product->description;
            $product->product_image = $request->input('product_image') ?: $product->product_image;
        
            $product->save();
            return response()->json('Produto atualizado com sucesso', 200);
        } catch (\Throwable $th) {
            return response()->json('Id invalido', 422);
        }
    }

    public function createProduct(ProductRequest $request){

        $extensao = $request->file('product_image')->extension();
        $nome = explode('.', $request->file('product_image')->getClientOriginalName());
        $nomeArquivo = uniqid(date('HisYmd') . $nome[0]);
        $nomeArquivo = "{$nome[0]}.{$extensao}";
        $upload = $request->file('product_image')->storeAs('public/teste', $nomeArquivo);
        
        try {
            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'product_image' => $nomeArquivo
            ]);

            $product->save();
            return response()->json('Produto criado com sucesso!', 200);
        } catch (\Throwable $th) {
            return response()->json('Não foi possivel adicionar o produto', 414);
        }
        



    }


}

