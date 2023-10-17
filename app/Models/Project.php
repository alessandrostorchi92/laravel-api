<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    use HasFactory;

    protected $fillable = [

        'slug',
        'title',
        'thumb',
        'description',
        'link',
        'published_date',
        'language',
        'type_id',

    ];

    // Questo metodo mette in relazione la tabella projects con quella types
    public function type() {
        
        // Più types possono appartenere ad un medesimo progetto
        return $this->belongsTo(Type::class);
         
    }

    // Questo metodo mette in relazione la tabella projects con quella technologies
    public function technologies() {

        // Un progetto può avere diverse technologies
        return $this->belongsToMany(Technology::class);
    }




}
