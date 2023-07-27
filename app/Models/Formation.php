<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Formation extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    public function line():BelongsTo
    {
        return $this->BelongsTo(Line::class);
    }
    public function formation_player(): HasMany
    {
        return $this->hasMany(FormationPlayer::class);
    }
    public function players():HasManyThrough
    {
        return $this->hasManyThrough(Player::class,FormationPlayer::class,'formation_id', 'id', 'id', 'player_id');
    }
}
