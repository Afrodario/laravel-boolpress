<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Lead;
use App\Mail\NewContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request) {

        $data = $request->all();

        //Creo una funzione di validazione alternativa a validate() tramite la classe Validator
        //per poter eseguire, in caso di fallimento, un pezzo di codice a mia discrezione, evitando
        //il ricaricamento della pagina
        $validator = Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        } else {

            $lead = new Lead();
            $lead->fill($data);
            $lead->save();

            //Posso inviare in questo modo una mail all'amministratore, creando una nuova istanza di NewContact, nel metodo send()
            //che prevede $lead come argomento (tutto specificato nel NewContact)
            Mail::to('support@boolpress.com')->send(new NewContact($lead));


            return response()->json([
                'success' => true
            ]);

        }



    }



}
