<?php

namespace Database\Seeders;

use App\Enums\PlayerPositionEnum;
use App\Models\Player;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 40; $i++) { //11 players 4-4-2 Seeder
            Player::create([
                'name'          => $faker->userName,
                't_shirt_num'   => $i + 1,
                'position'      => $faker->randomElement(
                    [
                        PlayerPositionEnum::Goalkeeper(),
                        PlayerPositionEnum::Defender(),
                        PlayerPositionEnum::Midfielder(),
                        PlayerPositionEnum::Attacker()
                    ]
                )
            ]);
        }
    }
}
