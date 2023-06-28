<?php

namespace Database\Seeders;

use App\Models\Vote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 100; $i++) {

            $vote = new Vote();

            $vote->user_id = random_int(2, 11);
            $vote->voter = $faker->name();
            $vote->vote = random_int(1, 5);

            $vote->save();
        }
    }
}
