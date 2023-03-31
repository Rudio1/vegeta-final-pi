<?php

namespace App\Http\Controllers;

use App\Http\Requests\PutUsers;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class InittialController extends Controller
{
    function __construct(){
        
    }

    public function findById(int $id){
        try {
            $User = User::find($id);

            if(!$User){
                return response()->json('Id invalido', 422);    
            }
            return response()->json($User, 200);
            
        } catch (\Throwable $th) {
            return response()->json('false', 500);
        }
    }

    public function deleteUser(int $id){
        try {
            $User = User::find($id);
            if(!$User) {
                return response()->json('Id informado não existe', 422);
            }

            $User->delete();
            return response()->json('Usuario deletado com sucesso!', 204);
        } catch (\Throwable $th) {
            return response()->json('false', 500);
        }
    }

    public function createUser(UserRequest $request){
        try {
                $User =User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                ]);                
                return response()->json($User, 200); 
        } catch (\Throwable $th) {
            return response()->json('false', 500);
        }
    }

    public function updateUser(PutUsers $request, int $id){

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
        } catch (\Throwable $th) {
            return response()->json('false', 500);
        }
        
    }
}
