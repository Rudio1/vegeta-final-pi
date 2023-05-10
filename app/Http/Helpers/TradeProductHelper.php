<?php

namespace App\Http\Helpers;

use App\Http\Controllers\ProductController;
use App\Http\Requests\TradeRequest;
use App\Models\ProductSelled;
use App\Models\User;
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
                ProductSelled::where('product_id', $currentProductId)
                    ->where('user_id', $user->id)
                    ->update(['user_id' => $newUser->id, 'resale' => 1]);
            
                return JsonResponseHelper::jsonResponse($currentProduct, 'Produto Transferido com sucesso', true);
            }
        } catch (\Exception $th) {
            return JsonResponseHelper::jsonResponse([], $th->getMessage(), 500, false);
        }
        throw new \Exception('Você nao possui produtos');
    }
}