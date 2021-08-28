<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gameSession extends Model
{
    //
    protected $fillable = ["attempts","ads","try_ads","user_id","game_id"];

}
