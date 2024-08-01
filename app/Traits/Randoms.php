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
                ->filter(fn ($v, $k) => $k < $numDigits)
                ->implode('');
        } while (substr($number, 0, 1) === '0');

        if(intval($number) === floatval($number)){
            return intval($number);
        }else{
            return floatval($number);
        }
        
    }
}
