<?php

namespace App\Traits;

trait Randoms
{

    //สุ่มตามหลัก
    public function randomByDigits(int $minDigits, int $maxDigits)
    {
        $numDigits = mt_rand($minDigits, $maxDigits);
        return mt_rand(10 ** ($numDigits - 1), 10 ** $numDigits - 1);
    }

    //สุ่มเฉพาะตัวเลข ที่แต่ละหลักต้องการ
    public function randomByFixNumbers(int $minDigits, int $maxDigits, array $fixNumbers)
    {
        $numDigits = mt_rand($minDigits, $maxDigits);

        $fixNumbers = collect($fixNumbers);

        do {
            $number = $fixNumbers->merge($fixNumbers)
                ->merge($fixNumbers)
                ->merge($fixNumbers)
                ->shuffle()
                ->take($numDigits)
                ->implode('');
        } while (substr($number, 0, 1) === '0');

        if(intval($number) === floatval($number)){
            return intval($number);
        }else{
            return floatval($number);
        }
        
    }

    private function generateRandomNumber(int $length, array $fixNumbers) {
        $number = '';

        for ($i = 0; $i < $length; $i++) {
            $digit = $fixNumbers[mt_rand(0, count($fixNumbers) - 1)];

            if($i===0 && $digit===0){
                $i--;
                continue;
            }
            
            $number .= $digit;
        }

        return (int)$number;
    }
    
    public function getRandomNumbers(int $minDigits1,int $maxDigits1,int $minDigits2,int $maxDigits2,array $fixNumbers1,array $fixNumbers2) {

        do {
            $number1 = $this->generateRandomNumber(mt_rand($minDigits1,$maxDigits1), $fixNumbers1);
            $number2 = $this->generateRandomNumber(mt_rand($minDigits2,$maxDigits2), $fixNumbers2);
        } while ($number1 <= $number2);
    
        return [$number1, $number2];
    }
    


    
}
