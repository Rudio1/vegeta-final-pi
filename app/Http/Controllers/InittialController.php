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

    public function findById($id){
        try {
            $User = User::find($id);
            return [
                $User->name,
                $User->email
            ];
        } catch (\Throwable $th) {
            return response()->json('Id invalido', 404);
        }
    }

    public function deleteUser($id){
        $User = User::find($id);
        try {
            $User->delete();
            return response()->json('Usuario deletado com sucesso!', 200);
        } catch (\Throwable $th) {
            return response()->json('Id informado não existe', 404);
        }
    }

    public function createUser(UserRequest $request){
        $password = $request->password;
        // dd($request->password_confirmed);
        
        if($password == $request->password_confirmed){
            dd($password);
            $User =User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($password),
            ]);                
            if($User){
                return response()->json('Usuario criado com sucesso!', 200); 
            }
            
        }
        return response()->json('As senhas devem ser iguais', 404);
    }

    public function updateUser(PutUsers $request, $id){

        
        $User = User::findorfail($id);
        if(!$User){
            return response()->json('Id invalido', 404);
        }
        $User->name = $request->input('name') ?: $User->name; 
        $User->email = $request->input('email') ?: $User->email; 
        $User->password = $request->input('password')?: bcrypt($User->password);
        $User->save();
        
        return response()->json('Usuario atualizado com sucesso!', 200);
        
    }
}
