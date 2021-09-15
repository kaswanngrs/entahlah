<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Task extends Model
{
    use SoftDeletes;
    protected $fillable = ['title','description','channel_name','url_link'];
    protected $dates = ['deleted_at'];
}
