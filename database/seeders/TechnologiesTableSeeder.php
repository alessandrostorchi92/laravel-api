<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Technology;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TechnologiesTableSeeder extends Seeder{

    /**
     * Run the database seeds.
     */

    public function run(Faker $faker): void {

        Technology::truncate();

        $technologies=['Vue', 'React', 'JS', 'TS', 'HTML5', 'CSS3', 'SCSS', 'Bootstrap', 'Tailwind', 'PHP', 'MySQL', 'Laravel', 'Flutter'];

        foreach ($technologies as $technology) {

            // $newType = new Technology();
            // $newType->name = $technology;
            // $newType->colour = $faker->rgbColor(); 
            // $newType->save();

            // Tutte queste operazioni possono essere riassunte in: 
            Technology::create([

                'name' => $technology,
                'colour' => $faker->rgbColor()

            ]);


        }
        


    }
}
