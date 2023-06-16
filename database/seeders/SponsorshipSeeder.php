<?php

namespace Database\Seeders;

use App\Models\Sponsorship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsorships = 
        [
            [
                'name' => 'Basic',
                'price' => 2.99,
                'duration' => 24
            ],
            [
                'name' => 'Premium',
                'price' => 5.99,
                'duration' => 72
            ],
            [
                'name' => 'Gold',
                'price' => 9.99,
                'duration' => 144
            ]
        ];

        foreach($sponsorships as $sponsorship) {
            $newSponsorship = new Sponsorship();

            $newSponsorship->slug = Str::slug($sponsorship['name']);
            $newSponsorship->name = $sponsorship['name'];
            $newSponsorship->price = $sponsorship['price'];
            $newSponsorship->duration = $sponsorship['duration'];

            $newSponsorship->save();
        }
    }
}
