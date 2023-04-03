<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function sendContatc(ContactRequest $request){
        try {
            $contact = Contact::create([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'description' => $request->description,
            ]);

            $contact->save();
            return response()->json('Mensagem enviada!', 200);
        } catch (\Throwable $th) {
            return response()->json('error', 500);
        }

    }
}
