<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdditionDot extends Model
{
    protected $fillable = ['numbers','level_id','difficulty_id'];
    
    public function getAnswerAttribute()
    {
        return array_sum($this->numbers);
    }
}
