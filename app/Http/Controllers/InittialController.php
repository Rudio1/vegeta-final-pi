<?php

namespace App\Http\Controllers;

use App\Http\Requests\PutUsers;
use App\Http\Requests\UserRequest;
use App\Mail\sendMailRegister;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class InittialController extends Controller
{
    function __construct(){
        
    }

    public function findById(int $id): JsonResponse{
        try {
            $User = User::find($id);

            if(!$User){
                return response()->json('Id invalido', 422);    
            }
            return response()->json($User, 200);
            
        } catch (\Exception $th) {
            return response()->json($th->getMessage(), 400);
        }
    }

    public function deleteUser(int $id): JsonResponse{
        try {
            $User = User::find($id);
            if(!$User) {
                return response()->json('Id informado não existe', 422);
            }

            $User->delete();
            return response()->json('Usuario deletado com sucesso!', 204);
        } catch (\Exception $th) {
            return response()->json($th->getMessage(), 400);
        }
    }

    public function createUser(UserRequest $request): JsonResponse{
        $nameUser = $request->name;
        try {
            $User =User::create([
                'name' => $nameUser,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

                Mail::to($request->email)->send(new sendMailRegister($nameUser));
                return response()->json('Email enviado' . $User, 200); 
        } catch (\Exception $th) {
            return response()->json($th->getMessage(), 400);
        }
    }

    public function updateUser(PutUsers $request, int $id) : JsonResponse{

        try {
            $User = User::findorfail($id);
            if(!$User){
                return response()->json('Id invalido', 422);
            }
            $User->name = $request->input('name') ?: $User->name; 
            $User->email = $request->input('email') ?: $User->email; 
            $User->password = $request->input('password')?: bcrypt($User->password);
            $User->save();

            return response()->json($User, 201);
        } catch (\Exception $th) {
            return response()->json($th->getMessage(), 400);
        }
        
    }
}
