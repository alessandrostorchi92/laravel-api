<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model {

    use HasFactory;

     // Questo metodo mette in relazione la tabella types con quella projects
    public function projects(){

        //Un type può avere tanti project
        return $this->hasMany(Project::class);
    }

}
