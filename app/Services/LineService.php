<?php
namespace App\Services;

use App\Models\Line;

class LineService {

    public function all()
    {
        return Line::orderBy('id','desc')->get();
    }
    public function add($request):Line
    {
        return Line::create([
            'no_defenders'  => $request->no_defenders,
            'no_midfielders'=> $request->no_midfielders,
            'no_attackers'  => $request->no_attackers
        ]);
    }
    public function update(int $id,$request)
    {
        $line = Line::findOrFail($id);
        return $line->update([
            'no_defenders'  => $request->no_defenders,
            'no_midfielders'=> $request->no_midfielders,
            'no_attackers'  => $request->no_attackers
        ]);
    }
    public function delete($id)
    {
        $line = Line::findOrFail($id);
        return $line->delete();
    }
}
