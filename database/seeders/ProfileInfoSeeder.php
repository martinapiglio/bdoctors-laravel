<?php

namespace Database\Seeders;

use App\Models\ProfileInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProfileInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 5; $i++){

            $profileInfo = new ProfileInfo;

            $profileInfo->curriculum = $faker->text(200);
            $profileInfo->profile_pic = $faker->url();
            $profileInfo->phone_number = $faker-> phoneNumber();
            $profileInfo->services = $faker->text(200);

            $profileInfo->save();

        }
    }
}
