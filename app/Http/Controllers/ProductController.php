<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\PutProduct;
use App\Http\Requests\SelledProduct;
use App\Models\Product;
use DateTime;
use GuzzleHttp\Psr7\Request;
use App\Models\Comments;
use App\Models\ProductSelled;
use App\Models\User;
use Egulias\EmailValidator\Warning\Comment;
use Illuminate\Http\JsonResponse;
class ProductController extends Controller
{
    public function getAllProduct() : JsonResponse{
        try {
            $products = Product::all();
            return response()->json($products);
        } catch (\Exception $th) {
            return response()->json($th->getMessage(), 400);
        }
    }

    public function findById(int $id) : JsonResponse{
        try {
            $product = Product::findOrFail($id);
            return response()->json($product, 200);
        } catch (\Exception $th) {
            return response()->json($th->getMessage(), 400);
        }
    }

    public function deleteProduct(int $id): JsonResponse{
        try {
            $product = Product::find($id);
            $product->delete();
            return response()->json('Produto deletado!', 200);
        } catch (\Exception $th) {
            return response()->json($th->getMessage(), 400);
        }
    }

    public function updateProduct(Request $request, int $id) :  JsonResponse{
        try {
            $product = Product::findOrFail($id);
            $product->name = $request->input('name') ?: $product->name;
            $product->price = $request->input('price') ?: $product->price;
            $product->description = $request->input('description') ?: $product->description;
            $product->product_image = $request->input('product_image') ?: $product->product_image;
        
            $product->save();
            return response()->json('Produto atualizado com sucesso', 200);
        } catch (\Exception $th) {
            return response()->json($th->getMessage(), 400);
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
        } catch (\Exception $th) {
            return response()->json($th->getMessage(), 400);
        }    
    }

    public function newComment(CommentRequest $request): JsonResponse{
        try {
            $user = auth()->user(); 
            $product = Product::where('name', $request->product_name)->firstOrFail();
            $maxAssessment = Comments::where('product_id', $product->id)->max('count_assessment');
            $countAssessment = $maxAssessment ? $maxAssessment + 1 : 1;

            $comment = Comments::create([
                'comment' => $request->comment,
                'assessment' => $request->assessment,
                'user_id' => $user->id, 
                'product_id' => $product->id,  
                'count_assessment' => $countAssessment,
                'avg_assessment' => (($product->comments()->avg('assessment') * $product->comments()->count()) + $request->assessment) / ($product->comments()->count() + 1),
            ]);

            $comment->save();
            return response()->json('Comentario adicionado', 200);
        } catch (\Exception $th) {
            return response()->json($th->getMessage(), 400);
        }
    }

    public function updateComment(Request $request, $id) : JsonResponse {
        try {
            $comment = Comments::findOrFail($id);
            $comment->comment = $request->input('comment') ?: $comment->comment;

            $comment->save();
            return response()->json('Comentario atualizado', 200);

        } catch (\Exception $th) {
            return response()->json($th->getMessage(), 400);
        }
    }

    public function deleteComment(int $id): JsonResponse {
        try {
            $comment = Comment::findOrFail($id);
            $comment->delete();
            return response()->json('Comentario deletado', 200);
        } catch (\Exception $th) {
            return response()->json($th->getMessage(), 400);
        }
    }

    public function showComment(int $productId) : JsonResponse{
        try {
            $getComment = Comments::where('product_id', $productId)->get();
            $comments = [];

            foreach ($getComment as $comment) {
                $user = User::find($comment->user_id);
                $commentData = [
                    'User' => $user->name,
                    'comment' => $comment->comment,
                    'assessment' => $comment->assessment,
                ];
                
                array_push($comments, $commentData);
        }
            return response()->json($comments, 200);

        } catch (\Exception $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function userProduct() : JsonResponse{
        try {
            $user = auth()->user();
            $product = Product::join('product_selleds', 'products.id', '=', 'product_selleds.product_id' )
                            ->where('product_selleds.user_id', $user->id)
                            ->select('products.*')
                            ->get();
            if(!$product->isEmpty()){
                return response()->json($product, 200);
            }else {
                return response()->json('Você ainda não possui produtos', 400);
            }            
        } catch (\Exception $th) {
            return response()->json($th->getMessage(), 400);
        }
    }

    public function selledProducts(SelledProduct $request) : JsonResponse {
        $date = new DateTime();
        $today = $date->format('Y-m-d');
        try {
            $user = User::where('email', $request->email_user)->firstOrFail();
            $product = Product::where('name', $request->product_name)->firstOrFail();

            if (ProductSelled::where('user_id', $user->id)
                            ->where('product_id', $product->id)
                            ->where('serie_number', $request->number_serie)
                            ->exists()){
                return response()->json('O produto já existe para o usuário', 400);    
            }
            $selledProduct = ProductSelled::create([
                'product_id' => $product->id,
                'user_id' => $user->id,
                'buy_date' => $today,
                'serie_number' => $request->number_serie,
            ]);

            $selledProduct->save();
            return response()->json($selledProduct, 200);
        } catch (\Exception $th) {
            return response()->json($th, 400);
        }
    }

}

