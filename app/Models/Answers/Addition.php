<?php

namespace App\Models\Answers;

use stdClass;

class Addition extends AnswerAbstract
{
    protected int $totalNumbers = 2;
    protected int $decimalPlaces =0;   

    public function setMinMaxDigits(int $minDigits, int $maxDigits): AnswerAbstract
    {
        $this->minDigits = $minDigits;
        $this->maxDigits = $maxDigits;
        return $this;
    }

    public function setTotalNumbers(int $totalNumbers): Addition
    {
        $this->totalNumbers = $totalNumbers;
        return $this;
    }   

    public function setDecimalPlaces(int $decimalPlaces): Addition
    {
        $this->decimalPlaces = $decimalPlaces;
        return $this;
    }

    public function get($numItems = 1): array
    {
        $quizzes = [];

        if ($this->difficulty === 'easy') {
            $fixNumbers = [0, 1, 2, 3, 4, 5];
        } else if ($this->difficulty === 'hard') {
            $fixNumbers = [4, 5, 6, 7, 8, 9];
        } else {
            $fixNumbers = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        }

        for ($i = 0; $i < $numItems; $i++) {

            $numbers = [];

            for ($j = 0; $j < $this->totalNumbers; $j++) {
                if($this->decimalPlaces===0){
                    $numbers[] = $this->randomByFixNumbers($this->minDigits, $this->maxDigits, $fixNumbers);
                }else{
                    $numbers[] =  $this->randomByFixNumbers($this->minDigits, $this->maxDigits, $fixNumbers)/10**(mt_rand(1,$this->decimalPlaces));
                }
            }

            $quizzes[] = (object)[
                'numbers' =>  array_map(fn($num)=>number_format($num,$this->decimalPlaces,'.',''),$numbers),
                'answer' => $this->dynamicNumberFormat(array_sum($numbers))
            ];
        }

        return $quizzes;
    }

    private function dynamicNumberFormat($number) {
        // Convert the number to a string to count decimal places
        $numberStr = (string) $number;
    
        // Find the position of the decimal point
        $decimalPos = strpos($numberStr, '.');
    
        // Calculate the number of decimal places
        $decimalPlaces = $decimalPos === false ? 0 : strlen($numberStr) - $decimalPos - 1;
    
        // Format the number with the calculated decimal places
        return number_format($number, $decimalPlaces, '.', ',');
    }
 
    
}
