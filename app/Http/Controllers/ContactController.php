<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function sendContact(ContactRequest $request) : JsonResponse{
        try {
            $user = auth()->user();
            $contact = Contact::create([
                'name' => $user->name,
                'category_id' => $request->category_id,
                'description' => $request->description,
            ]);
            $contact->save();
            return response()->json('Mensagem enviada!', 200);
        } catch (\Exception $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
