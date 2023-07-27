<?php

namespace App\Services;

use App\Models\Formation;
use App\Models\Line;
use Illuminate\Support\Facades\DB;

class FormationService
{

    public function all()
    {
        return Formation::with(['line', 'players'])->orderBy('id', 'desc')->get();
    }
    public function store($request)
    {
        DB::beginTransaction();
        try {
            $selectedLine = Line::findOrFail($request->selectedLine['id']);

            $formation = Formation::create(['line_id' => $selectedLine->id]);

            $selectedPlayers = collect($request->selectedPlayers);

            // Create the goalkeeper record
            $formation->formation_player()->create([
                'player_id' => $selectedPlayers['goalkeeper']['id']
            ]);

            // Create defenders
            for ($i = 1; $i <= $selectedLine->no_defenders; $i++) {
                $defender = $selectedPlayers['defender' . $i];
                $formation->formation_player()->create([
                    'player_id' => $defender['id']
                ]);
            }

            // Create midfielders
            for ($i = 1; $i <= $selectedLine->no_midfielders; $i++) {
                $midfielder = $selectedPlayers['midfielder' . $i];
                $formation->formation_player()->create([
                    'player_id' => $midfielder['id']
                ]);
            }

            // Create attackers
            for ($i = 1; $i <= $selectedLine->no_attackers; $i++) {
                $attacker = $selectedPlayers['attacker' . $i];
                $formation->formation_player()->create([
                    'player_id' => $attacker['id']
                ]);
            }

            DB::commit();
            return response()->json('Success', 201);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return response()->json('Failed', 401);
        }
    }
    public function add($request)
    {
    }
    public function update(int $id, $request)
    {
    }
    public function delete($id)
    {
        $line = Formation::findOrFail($id);
        return $line->delete();
    }
}
