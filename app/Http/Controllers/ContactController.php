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
            dd($category);
            $user = auth()->user();
            $contact = Contact::create([
                'name' => $user->name,
                'category_id' => $category,
                'description' => $request->description,
            ]);
            $contact->save();
            return JsonResponseHelper::jsonResponse([], 'Mensagem enviada!', true);
        } catch (\Exception $th) {
            return JsonResponseHelper::jsonResponse([], $th->getMessage(), false, 500);
        }
    }
}
