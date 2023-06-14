<?php

namespace Database\Seeders;

use App\Models\Detail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class DetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 5; $i++){

            $detail = new Detail();

            $detail->slug = '';
            $detail->curriculum = $faker->text(200);
            $detail->profile_pic = $faker->url();
            $detail->phone_number = $faker-> phoneNumber();
            $detail->services = $faker->text(200);

            $detail->save();

        }
    }
}
