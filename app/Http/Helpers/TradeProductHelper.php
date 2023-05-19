<?php

namespace App\Http\Helpers;

use App\Http\Controllers\ProductController;
use App\Http\Requests\TradeRequest;
use App\Models\ProductSelledHistoric;
use App\Models\ProductSelled;
use App\Models\User;
use App\Models\Product;
use Illuminate\Auth\AuthManager;




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
            $currentProduct = $this->productController->userProduct()->original['data'];

            foreach ($currentProduct as $value){
                $currentProductId = $value->id;
            }
            if($currentProduct){
                $historic = ProductSelled::select('id')->where('product_id', $currentProductId)
                ->where('user_id', $user->id)->first();
                ProductSelledHistoric::create([
                    'old_user_id' => $user->id,
                    'new_user_id' => $newUser->id,
                    'product_selleds_id' => $historic->id,
                ]);

                //fazer datediff data de validade
                

                ProductSelled::where('product_id', $currentProductId)
                    ->where('user_id', $user->id)
                    ->update(['user_id' => $newUser->id, 'resale' => 1]);

                return JsonResponseHelper::jsonResponse([$currentProduct, 'message' => 'Produto Transferido com sucesso']);
            }
            return JsonResponseHelper::jsonResponse(['message' => 'Você nao possui produtos'], 500);
        } catch (\Exception $th) {
            return JsonResponseHelper::jsonResponse(['message' => $th->getMessage()], 500);
        }
        
    }
}