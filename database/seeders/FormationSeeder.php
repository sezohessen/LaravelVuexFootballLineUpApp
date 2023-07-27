<?php

namespace Database\Seeders;

use App\Enums\PlayerPositionEnum;
use App\Models\Formation;
use App\Models\Line;
use App\Models\Player;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class FormationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $lines = Line::all();
        $goalKeepersPlayers = Player::where('position',PlayerPositionEnum::Goalkeeper())->get();
        $defendersPlayers   = Player::where('position',PlayerPositionEnum::Defender())->get();
        $midfieldersPlayers = Player::where('position',PlayerPositionEnum::Midfielder())->get();
        $attackersPlayers   = Player::where('position',PlayerPositionEnum::Attacker())->get();
        for ($i=0; $i < 5; $i++) {
            $formation = Formation::create([
                'line_id'   => $lines->random()->id,
            ]);
            //Goal Keeper
            $formation->formation_player()->create([
                'player_id' => $goalKeepersPlayers->random()->id
            ]);
            //Defenders
            for ($j=0; $j < $formation->line->no_defenders; $j++) {
                $formation->formation_player()->create([
                    'player_id' => $defendersPlayers->random()->id
                ]);
            }
            //Midfielders
            for ($j=0; $j < $formation->line->no_midfielders; $j++) {
                $formation->formation_player()->create([
                    'player_id' => $midfieldersPlayers->random()->id
                ]);
            }
            //Attackers
            for ($j=0; $j < $formation->line->no_attackers; $j++) {
                $formation->formation_player()->create([
                    'player_id' => $attackersPlayers->random()->id
                ]);
            }
        }
    }
}
