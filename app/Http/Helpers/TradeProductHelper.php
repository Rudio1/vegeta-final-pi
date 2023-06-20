<?php

namespace App\Http\Helpers;

use App\Http\Controllers\ProductController;
use App\Http\Requests\TradeRequest;
use App\Models\ProductSelledHistoric;
use App\Models\ProductSelled;
use App\Models\User;
use App\Models\Product;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Carbon;




class TradeProductHelper
{

    private $auth;
    private $request;
    private $productController;

    public function __construct(AuthManager $auth, TradeRequest $request, ProductController $productController)
    {
        $this->auth = $auth;
        $this->request = $request;
        $this->productController = $productController;
    }

    public function tradeProduct() {
    
        try {
            $user = $this->auth->user();
            $newUser = User::where('email', $this->request->new_user)->firstOrFail();
            $productId = Product::select('id')->where('name', $this->request->product_name)->first()->id;
            
            $currentProductId = Product::select('products.id')
                            ->join('product_selleds', 'product_selleds.product_id', '=', 'products.id')
                            ->where('products.id', $productId)
                            ->where('product_selleds.serie_number', $this->request->serie_number)
                            ->where('product_selleds.user_id', $user->id)
                            ->first();
            
            if($currentProductId == null){
                return JsonResponseHelper::jsonResponse(['message' => 'Você nao possui o produto com esse numero de serie'], 404);
            }

            $historic = ProductSelled::select('id')->where('product_id', $currentProductId->id)
            ->where('user_id', $user->id)->first();
            ProductSelledHistoric::create([
                'old_user_id' => $user->id,
                'new_user_id' => $newUser->id,
                'product_selleds_id' => $historic->id,
            ]);

            ProductSelled::where('product_id', $currentProductId->id)
                    ->where('serie_number', $this->request->serie_number)
                    ->update(['user_id' => $newUser->id, 'resale' => 1]);

            return JsonResponseHelper::jsonResponse(['message' => 'Produto Transferido com sucesso para o usuario ' . $newUser->name]);
            
        } catch (\Exception $th) {
            return JsonResponseHelper::jsonResponse(['message' => $th->getMessage()], 500);
        }
        
    }
}