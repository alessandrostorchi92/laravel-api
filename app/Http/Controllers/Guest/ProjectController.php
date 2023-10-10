<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Project;

class ProjectController extends Controller
{

    //*'INDEX' FUNCTION

    /**
     * Ritorna la lista di tutti i progetti all'interno della view "guests.projects.index"
     *
     * @return View
     */


    public function index(): View {
        
        return view("guests.index");
    }
}
