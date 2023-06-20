<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 50; $i++){

            $review = new Review();

            $review->user_id = random_int(2, 6);
            $review->name = $faker->name();
            $review->description = $faker->text(200);

            $review->save();

        }
    }
}
