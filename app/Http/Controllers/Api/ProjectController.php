<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller {

    public function index() {

        // Recupero i dati dal DB 
        // $projects = Project::all(); Il metodo all() può rallentare il server per l'entità dei dati derivanti dalle chiamate API come ha fatto Islam, mandando in crush il database di yu-gi-oh

        //Con il metodo paginate() vado a fare una request la cui risposta sarà soltanto di n elementi per pagina in  base al numero che inserisco (di default è pari a 15). In più recuperiamo in modo ottimizzato i dati dei model collegati attraverso il metodo with(). Infine, dobbiamo passare come parametri i nomi dei metodi specificati nel model oggetto al paginate()

        $projects = Project::with(["type", "technologies"])->paginate(6);

        // Restituisco i dati in formato JSON. Questo serve per poter accedere ai dati projects mediante la chiave "results"
        return response()->json([

            "message" => 'Projects List',
            "results" => $projects,

        ]);

        

    }
    
}
