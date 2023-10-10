<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\View\View;

use Illuminate\Http\Request;

class ProjectController extends Controller
{

    /**
     * Ritorna la lista di tutti i progetti all'interno della view "projects.index"
     *
     * @return View
     */

    public function index(): View
    {

        $projects = Project::all();

        return view("admin.projects.index", compact("projects"));
    }

    /**
     * Recupera il progetto che corrisponde all'id ricevuto come argomento
     * e lo ritorna all'interno della view "projects.show"
     *
     * @param int $id ID del fumetto da visualizzare
     * @return View
     */

    public function show($id): View
    {

        $selectedComic = Project::findOrFail($id);

        return view("admin.projects.show", compact("projects"));
    }
}
