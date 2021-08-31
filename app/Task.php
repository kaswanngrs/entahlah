<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Task extends Model
{
    use SoftDeletes;
    //Task
    protected $fillable = ['Task'];
    protected $dates = ['deleted_at'];
}
