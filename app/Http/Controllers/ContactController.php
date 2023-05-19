<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Http\Helpers\JsonResponseHelper;
use App\Models\Category;

class ContactController extends Controller
{
    public function sendContact(ContactRequest $request) : JsonResponse{
        try {
            $category = Category::select('id')
                    ->where('name', $request->category)->first();
            $user = auth()->user();
            $contact = Contact::create([
                'name' => $user->name,
                'category_id' => $category->id,
                'description' => $request->description,
            ]);
            unset($contact->id);
            return JsonResponseHelper::jsonResponse(['contact' => $contact, 'message' => 'Mensagem enviada!']);
        } catch (\Exception $th) {
            return JsonResponseHelper::jsonResponse([], $th->getMessage(), 500);
        }
    }
}
