<?php

namespace Database\Seeders;

use App\Models\Spec;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class SpecSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $specs = 
        [
            'Cardiologia',
            'Dermatologia',
            'Endocrinologia',
            'Gastroenterologia',
            'Neurologia',
            'Oftalmologia',
            'Ortopedia',
            'Pediatria',
            'Psichiatria',
            'Radiologia',
            'Oncologia',
            'Chirurgia',
            'Urologia' 
        ];

        foreach($specs as $spec) {
            $newSpec = new Spec();

            $newSpec->title = $spec;
            $newSpec->icon = $faker->url();

            $newSpec->save();
        }
    }
}
