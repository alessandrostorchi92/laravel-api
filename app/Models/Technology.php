<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{

    use HasFactory;

    // Questo metodo mette in relazione la tabella technologies con quella projects 
    public function projects() {

        // Una tecnology  può appartenere a più projects
        return $this->belongsToMany(Project::class);

    }
}
