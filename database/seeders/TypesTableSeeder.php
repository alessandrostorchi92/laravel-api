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

            $newType = new Type();
            $newType->name = $type;    
            $newType->save();

        }

        
    }

}
