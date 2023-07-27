<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddPlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Http\Resources\PlayerResource;
use App\Models\Player;
use App\Services\PlayerService;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PlayerService $player)
    {
        $players = $player->all();

        return response()->json(PlayerResource::collection($players));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddPlayerRequest $request, PlayerService $player)
    {
        // Create the new player
        $new_player = $player->add($request);

        return response()->json($new_player, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlayerRequest $request, $id, PlayerService $player)
    {
        // Update the new player
        $new_player = $player->update($id, $request);

        return response()->json($new_player, 201);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, PlayerService $player)
    {
        // Delete the new player
        $player->delete($id);
        return response()->json('Success', 201);
    }
}
