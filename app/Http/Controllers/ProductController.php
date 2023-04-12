<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\PutProduct;
use App\Models\Product;
use App\Models\Comments;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    public function getAllProduct() : JsonResponse{
        try {
            $products = Product::all();
            return response()->json($products);
        } catch (\Exception $th) {
            return response()->json('error', 500);
        }
    }

    public function findById(int $id) : JsonResponse{
        try {
            $product = Product::findOrFail($id);
            return response()->json($product, 200);
        } catch (\Throwable $th) {
            return response()->json('error', 500);
        }
    }

    public function deleteProduct(int $id): JsonResponse{
        try {
            $product = Product::find($id);
            if(!$product){
                return response()->json('Id informado não existe', 422);
            }
            $product->delete();
            return response()->json('Produto deletado!', 200);
        } catch (\Throwable $th) {
            return response()->json('error', 500);
        }
    }

    public function updateProduct(PutProduct $request, int $id) :  JsonResponse{
        try {
            $product = Product::findOrFail($id);
            if($request->all() == []){
                return response()->json('Informe ao menos um campo à ser atualizado', 422);
            }
            $product->name = $request->input('name') ?: $product->name;
            $product->price = $request->input('price') ?: $product->price;
            $product->description = $request->input('description') ?: $product->description;
            $product->product_image = $request->input('product_image') ?: $product->product_image;
        
            $product->save();
            return response()->json('Produto atualizado com sucesso', 200);
        } catch (\Throwable $th) {
            return response()->json('error', 500);
        }
    }

    public function createProduct(ProductRequest $request) :  JsonResponse{
        try {
            $extensao = $request->file('product_image')->extension();
            $nome = explode('.', $request->file('product_image')->getClientOriginalName());
            $nomeArquivo = uniqid(date('HisYmd') . $nome[0]);
            $nomeArquivo = "{$nome[0]}.{$extensao}";
            $request->file('product_image')->storeAs('public/teste', $nomeArquivo);
            
            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'product_image' => $nomeArquivo
            ]);
            $product->save();
            return response()->json('Produto criado com sucesso!', 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 400);
        }    
    }

    public function newComment(CommentRequest $request): JsonResponse{
        try {
            $user = User::where('email', $request->email_user)->firstOrFail();
            $email_user_id = $user->id;

            $countAssessment = DB::table('comments_posts')->count('assessment');
            $comment = Comments::create([
                'comment' => $request->comment,
                'assessment' => $request->assessment,
                'user_id' => $email_user_id, 
                'product_id' => 1,  
                'count_assessment' => $countAssessment,
                'avg_assessment' => 2,
            ]);

            $comment->save();
        } catch (\Exception $th) {
            return response()->json($th->getMessage(), 400);
        }
    }


}

