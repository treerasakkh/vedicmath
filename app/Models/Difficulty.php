<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Difficulty extends Model
{
    protected $table ='difficulties';
    protected $fillable = ['code','explain'];
}
