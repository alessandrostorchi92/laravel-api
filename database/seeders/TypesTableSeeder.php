<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     */

    public function run(): void {

        $types=[

            "Front-End",
            "Back-End",
            "FullStack",
            "UX Design",
            "UI Design",

        ];

        foreach ($types as $type) {

            // $newType = new Type();
            // $newType->name = $type["name"];    
            // $newType->save();

            // Per risparmiare righe di codice posso usare questo comando per eseguire tutte le tre operazioni precedenti 

            Type::create([

                $type => 'name']);

        }

        
    }

}
