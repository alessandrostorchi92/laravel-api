<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProjectUpdateRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     */

    public function authorize(): bool {
        
        // Recupero l'utente attualmente loggato

        $user = Auth::user();

        // se l'email é storchi.alle@gmail.com, l'utente è autorizzato ad accedere alle mregole di validazione.
        if ($user->email === "storchi.alle@gmail.com") {

            return true;

        }

        // Altriementi l'operazione viene bloccata e ritorna un errore 403 di non autorizzazione
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    public function rules(): array {

        return [

            "title" => "required|string|max:100",
            "description" => "nullable|string|max:500",
            "thumb" => "nullable|url|max:5120",
            "link" => "required|url",
            "published_date" => "nullable|date",
            "language" => "nullable|string|max:50",
            "type_id"=> "exists:types,id",
            "technologies"=> "nullable|array",

        ];
    }

/**
 * Get the error messages for the defined validation rules.
 *
 * @return array<string, string>
 */

public function messages(): array {

    return [
        
        'title.required' => "Devi specificare un titolo per il progetto",
        'title.max' => "Il titolo deve avere al massimo 100 caratteri (spazi compresi)",
        'description.max' => "La descrizione non deve superare i 500 caratteri (spazi compresi)",
        'link.required' => "Il link è obbligatorio",
        'link.url' =>  "L'url inserito non è valido",
        'thumb.url' =>  "L'url inserito non è valido",
        'thumb.max' => "Ops! L'immagine supera la lunghezza massima di 5120 caratteri",
        'published_date.date' => "La data non è espressa nel formato giusto",
        'language.max' => "Il nome della lingua indicata supera i 50 caratteri",

    ];
}

}
