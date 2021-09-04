<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConterQuestion extends Model
{
    protected $fillable  = ["user_id","question_id"];
}
