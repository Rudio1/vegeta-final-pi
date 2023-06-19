<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\PutUsers;
use App\Http\Requests\UserRequest;
use App\Mail\ConfirmacaoCadastro;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Helpers\JsonResponseHelper;
use App\Http\Requests\PasswordRequest;
use GuzzleHttp\Psr7\Request;

class UserController extends Controller
{
    public function login(LoginRequest $request){
        try {
            if (Auth::attempt($request->only('email', 'password'))){
                $user = User::select('name')->where('email', $request->email)->first();
                $token = auth('api')->attempt($request->only('email', 'password'));
                return JsonResponseHelper::jsonResponse(['token'=> $token, 'user' => $user->name, 'message'=>'Login efetuado com sucesso']);
            } else {
                return JsonResponseHelper::jsonResponse(['message'=> 'Usuario ou senha invalido'], 401);       
            }
        } catch (\Exception $th) {
            return JsonResponseHelper::jsonResponse(['message'=> $th->getMessage()], 500);
        }
    }

    public function logout(){
        try {
            auth('api')->logout();
            auth('api')->invalidate(true);
            return JsonResponseHelper::jsonResponse(['message' => 'Logout efetuado com sucesso']);
        } catch (\Exception $th) {
            return JsonResponseHelper::jsonResponse(['message' => $th->getMessage()], 500);
        }
    }

    public function allUsers(): JsonResponse{
        try {
            $User = User::all();
            return JsonResponseHelper::jsonResponse($User);   
        } catch (\Exception $th) {
            return JsonResponseHelper::jsonResponse(['message' => $th->getMessage()], 500);
        }
    }

    public function deleteUser(int $id): JsonResponse{
        try {
            $User = User::findOrfail($id);
            $User->delete();
            return JsonResponseHelper::jsonResponse(['message'=>'Usuario deletado com sucesso!']);
        } catch (\Exception $th) {
            return JsonResponseHelper::jsonResponse(['message' => $th->getMessage()], 500);
        }
    }

    public function forgetPassword(PasswordRequest $request) {
        try {
            $user = User::where('email', $request->email)->first();
            $user->password = bcrypt($request->input('password')) ?: bcrypt($user->password);
            $user->save();
            return JsonResponseHelper::jsonResponse(['message'=>'Senha alterada com sucesso']);
        } catch (\Throwable $th) {
            return JsonResponseHelper::jsonResponse(['message'=>$th->getMessage()]);
        }
    }

    public function createUser(UserRequest $request): JsonResponse{
        $nameUser = $request->name;
        try {
            User::create([
                'name' => $nameUser,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            // Mail::to($request->email)->send(new ConfirmacaoCadastro($nameUser)); Envio de e-mail para confirmação de cadastro
            return JsonResponseHelper::jsonResponse(['message' => 'Usuario Criado'], 201);
        } catch (\Exception $th) {
            return JsonResponseHelper::jsonResponse(['message' => $th->getMessage()], 500);
        }
    }

    public function updateUser(PutUsers $request, int $id) : JsonResponse{
        try {
            $User = User::findorfail($id);
            $User->name = $request->input('name') ?: $User->name; 
            $User->save();
            return JsonResponseHelper::jsonResponse(['message' => 'Usuario atualizado de id ' . $User->id . ' atualizado com sucesso']);
        } catch (\Exception $th) {
            return JsonResponseHelper::jsonResponse(['message' => $th->getMessage()], 500);
        }
    }
}
