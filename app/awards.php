<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class awards extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'img', 'point'];



}
