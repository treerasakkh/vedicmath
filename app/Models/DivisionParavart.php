<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DivisionParavart extends Model
{
    protected $fillable = ['number1','number2','level_id','difficulty_id'];
    
    public function getAnswerAttribute()
    {
        return [
            'product'=>intdiv($this->number1,$this->number2),
            'reminder'=>$this->number1 % $this->number2,
        ];
    }
}
