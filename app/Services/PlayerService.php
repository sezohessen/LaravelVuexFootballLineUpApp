<?php
namespace App\Services;

use App\Enums\PlayerPositionEnum;
use App\Models\Player;

class PlayerService {

    public function all()
    {
        return Player::orderBy('id','desc')->get();
    }
    public function goalkeepers()
    {
        return Player::where('position',PlayerPositionEnum::Goalkeeper())->orderBy('id','desc')->get();
    }
    public function defenders()
    {
        return Player::where('position',PlayerPositionEnum::Defender())->orderBy('id','desc')->get();
    }
    public function midfielders()
    {
        return Player::where('position',PlayerPositionEnum::Midfielder())->orderBy('id','desc')->get();
    }
    public function attackers()
    {
        return Player::where('position',PlayerPositionEnum::Attacker())->orderBy('id','desc')->get();
    }
    public function add($request):Player
    {
        return Player::create([
            'name'          => $request->name,
            't_shirt_num'   => $request->t_shirt,
            'position'      => $request->position
        ]);
    }
    public function update(int $id,$request)
    {
        $player = Player::findOrFail($id);
        return $player->update([
            'name'          => $request->name,
            't_shirt_num'   => $request->t_shirt,
            'position'      => $request->position
        ]);
    }
    public function delete($id)
    {
        $player = Player::findOrFail($id);
        return $player->delete();
    }
}
