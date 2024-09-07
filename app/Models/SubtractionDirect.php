<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubtractionDirect extends Model
{
    protected $fillable = ['number1','number2','level_id','difficulty_id'];
    
    public function getAnswerAttribute()
    {
        return $this->number1 - $this->number2;
    }
}
