<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Winer extends Model
{
    //

    protected $fillable = [
        'code', 'user_id','award_id','status'
    ];


    public function user()
    {
        return $this->hasMany(User::class,'user_id');
    }


    public function award()
    {
        return $this->hasMany(awards::class,'award_id');
    }

}

