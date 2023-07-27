<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'  => $this->id,
            'no_defenders'  => $this->no_defenders,
            'no_midfielders'  => $this->no_midfielders,
            'no_attackers'  => $this->no_attackers,
        ];
    }
}
