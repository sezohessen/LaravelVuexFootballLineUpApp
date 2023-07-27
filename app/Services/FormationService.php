<?php

namespace App\Services;

use App\Models\Formation;
use App\Models\Line;

class FormationService
{

    public function all()
    {
        return Formation::with(['line', 'players'])->orderBy('id', 'desc')->get();
    }
    public function store($request)
    {
        try {
            $selectedLine   = collect($request->selectedLine);
            $line = Line::findOrFail($selectedLine['id']);
            $selectedPlayers = collect($request->selectedPlayers);
            for ($i=0; $i < $line->no_defenders; $i++) {
                $defender = $selectedPlayers['defender' . $i + 1];
            }
            for ($i=0; $i < $line->no_midfielders; $i++) {
                $midfielder = $selectedPlayers['midfielder' . $i + 1];
            }
            for ($i=0; $i < $line->no_attackers; $i++) {
                $attacker = $selectedPlayers['attacker' . $i + 1];
            }
            $formation = Formation::create([
                'line_id'   => $line->id,
            ]);
            $goalkeeper = $selectedPlayers['goalkeeper'];
            $formation->formation_player()->create([
                'player_id' => $goalkeeper['id']
            ]);
            for ($i=0; $i < $line->no_defenders; $i++) {
                $defender = $selectedPlayers['defender' . $i + 1];
                $formation->formation_player()->create([
                    'player_id' => $defender['id']
                ]);
            }
            for ($i=0; $i < $line->no_midfielders; $i++) {
                $midfielder = $selectedPlayers['midfielder' . $i + 1];
                $formation->formation_player()->create([
                    'player_id' => $midfielder['id']
                ]);
            }
            for ($i=0; $i < $line->no_attackers; $i++) {
                $attacker = $selectedPlayers['attacker' . $i + 1];
                $formation->formation_player()->create([
                    'player_id' => $attacker['id']
                ]);
            }
        } catch (\Exception $e) {
            dd($e);
            return response()->json('Failed', 401);
        }
        return response()->json('Success', 201);
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
