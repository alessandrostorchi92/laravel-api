<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller {

    public function index() {

        // Recupero i dati dal DB 
        $projects = Project::all();

        // Restituisco i dati in formato JSON
        return response()->json([

            //Questo serve per poter accedere ai dati projects mediante la chiave "results"
            "results" => $projects

        ]);

    }
    
}
