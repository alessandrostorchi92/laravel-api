<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectStoreRequest;
use App\Models\Project;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class ProjectController extends Controller
{

    //*'INDEX' FUNCTION

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

    //*'SHOW' FUNCTION

    /**
     * Recupera il progetto che corrisponde all'id ricevuto come argomento
     * e lo ritorna all'interno della view "projects.show"
     *
     * @param string $slug del progetto da visualizzare
     * @return View
     */

    public function show(string $slug): View {

        $project = Project::where("slug", $slug)->firstOrFail(); // $project[0]

        return view("admin.projects.show", compact("project"));
    }

    //*'CREATE' FUNCTION

    /**
     * Ritorna una view per la creazione di un nuovo progetto
     * La view conterrà un form per poter inserire i dati del progetto
     *
     * @return View
     */

    public function create(): View {
        return view("admin.projects.create");
    }

    //*'STORE' FUNCTION

    /**
     * Riceve i dati inviati dal form create e li salva nel database
     * creando un nuovo record nella tabella projects
     *
     * @param ProjectStoreRequest $request
     * @return RedirectResponse
     */

    public function store(ProjectStoreRequest $request): RedirectResponse {

        // Procedo alla validazione base dei dati ricevuti

        $data = $request->validated();

        $data["slug"] = $this->generateSlug($data["title"]);

        $data["language"] = json_encode([$data["language"]]);

        $data["slug"] = Str::slug($data["title"]);

        // dd($data);

        // $project = new Project();
        // $project->fill($data);
        // $project->save();

        // Il ::create esegue le operazioni l'istanza di Project, il fill() e il save() in un unico comando
        $project = Project::create($data);

        return redirect()->route("admin.projects.show", $project->slug);
    }

    /**
     * Ritorna una view "admin.projects.edit" con all'interno un form per modificare i dati dei progetti che corrisponde all'id ricevuto come argomento
     *
     * @param string $slug del progetto da modificare
     * @return View
     */

    public function edit(string $slug): View {

        $project = Project::where("slug", $slug)->firstOrFail();

        return view("admin.projects.edit", compact("project"));

    }

    /**
     * Riceve i dati inviati dal form edit e aggiorna il progetto che corrisponde
     * allo slug indicato come argomento
     *
     * @param Request $request
     * @param string $slug del progetto da modificare
     * @return RedirectResponse
     */

     public function update(Request $request, int $id): RedirectResponse {
        
        $project = Project::where("slug", $slug)->firstOrFail();

        $data = $request->validated();




    /**
     * Funzione per generare gli Slugs
     *
     * @param string $title del progetto
     * @return string $slug del titolo del progetto
     */

    protected function generateSlug($title) {

        $counter = 0;

        do {

            // Creo uno slug e se il counter è maggiore di 0, allora concateno il counter
            $slug = Str::slug($title) . ($counter > 0 ? "-" . $counter : "");


            // Cerco se esiste già un elemento con questo slug
            $alreadyExists = Project::where("slug", $slug)->first();

            $counter++;
        } while ($alreadyExists);

        return $slug;
    }
}
