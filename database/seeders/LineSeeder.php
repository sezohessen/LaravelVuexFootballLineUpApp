<?php

namespace Database\Seeders;

use App\Models\Line;
use App\Models\Lines;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class LineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Line::create([
            'no_defenders'  => 4,
            'no_midfielders'  => 4,
            'no_attackers'  => 2,
        ]);
        Line::create([
            'no_defenders'  => 4,
            'no_midfielders'  => 3,
            'no_attackers'  => 3,
        ]);
        Line::create([
            'no_defenders'  => 4,
            'no_midfielders'  => 5,
            'no_attackers'  => 1,
        ]);
        Line::create([
            'no_defenders'  => 3,
            'no_midfielders'  => 4,
            'no_attackers'  => 3,
        ]);
        Line::create([
            'no_defenders'  => 3,
            'no_midfielders'  => 5,
            'no_attackers'  => 2,
        ]);
        Line::create([
            'no_defenders'  => 3,
            'no_midfielders'  => 6,
            'no_attackers'  => 1,
        ]);
        Line::create([
            'no_defenders'  => 5,
            'no_midfielders'  => 3,
            'no_attackers'  => 2,
        ]);
        Line::create([
            'no_defenders'  => 5,
            'no_midfielders'  => 4,
            'no_attackers'  => 1,
        ]);
        Line::create([
            'no_defenders'  => 2,
            'no_midfielders'  => 3,
            'no_attackers'  => 5,
        ]);
        Line::create([
            'no_defenders'  => 4,
            'no_midfielders'  => 2,
            'no_attackers'  => 4,
        ]);

    }
}
