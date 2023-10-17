<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
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

    public function show(string $slug): View
    {

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

    public function create(): View
    {

        $types = Type::all();

        // Così la view ha a disposizione una variabile "types", che contiene tutti i type della tabella types 
        return view("admin.projects.create", compact("types"));
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

        // dd($data); OK 

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

    //*'EDIT' FUNCTION

    /**
     * Ritorna una view "admin.projects.edit" con all'interno un form per modificare i dati dei progetti che corrisponde all'id ricevuto come argomento
     *
     * @param string $slug del progetto da modificare
     * @return View
     */

    public function edit(string $slug): View {

        $project = Project::where("slug", $slug)->firstOrFail();
        $types = Type::all();
        $technologies = Technology::all();

        return view("admin.projects.edit", compact("project", "types", "technologies"));
    }

    //*'UPDATE' FUNCTION

    /**
     * Riceve i dati inviati dal form edit e aggiorna il progetto che corrisponde
     * allo slug indicato come argomento
     *
     * @param ProjectUpdateRequest $request
     * @param string $slug del progetto da modificare
     * @return RedirectResponse
     */

    public function update(ProjectUpdateRequest $request, string $slug): RedirectResponse {

        $project = Project::where("slug", $slug)->firstOrFail();
        $data = $request->validated();
        // Il validated ritorna un array $data["title]
        //Il firstOrFail ritorna un'istanza di classe $project->title
        // dd($data) OK; 

        // Se il titolo è diverso da quello originale, allora devo anche rigenerare lo slug relativo
        if ($data["title"] !== $project->title) {
            $data["slug"] = $this->generateSlug($data["title"]);
        }

        // $project = new Project();
        // $project->fill($data);
        // $project->save();

        // L'update() esegue le operazioni: l'istanza di Project, il fill() e il save() in un unico comando

        //Assegnazione technologies per scrivere all’interno della tabella pivot i records, creando quindi una relazione tra due record, usando il metodo attach(). prima di assegnare i nuovi tag, in caso di ulteriore modifica, cancello quelli precedenti
        
        // $project->technologies()->detach();
        // $project->technologies()->attach($data["technologies"]);

        //TODO Per aggiungere ed eliminare contemporaneamente dei record all’interno della tabella pivot possiamo utilizzare il metodo sync()

        $project->technologies()->sync($data["technologies"]);

        $project->update($data);

        return redirect()->route("admin.projects.show", $project->slug);
    }

    //*'DELETE' FUNCTION

    /**
     * Rimuove il progetto che corrisponde allo slug ricevuto come argomento
     *
     * @param string $slug del progetto da eliminare
     * @return RedirectResponse
     */

    public function destroy(string $slug): RedirectResponse {

        // Conferisco solo all'admin la facoltà di eliminare i progetti 

        if (Auth::user()->email !== "storchi.alle@gmail.com") {
            return abort(403);
        }

        $project = Project::where("slug", $slug)->firstOrFail();

        // elimino il progetto
        $project->delete();

        return redirect()->route("admin.projects.index");
    }




    /**
     * Funzione per generare gli Slugs: In sintesi, questa funzione genera uno slug a partire dal titolo di un progetto e assicura che il risultante slug sia univoco all'interno del database dei progetti. Se esistono più progetti con lo stesso titolo, verranno generati slug diversi aggiungendo un contatore numerico alla fine.
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
        // Se la variabile $alreadyExists è true allora ritorna lo slug altrimenti il ciclio do rincomincia con il counter incrementato di 1 

        return $slug;
    }
}
