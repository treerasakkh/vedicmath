<?php

namespace Database\Seeders;

use App\Models\Difficulty;
use App\Models\Level;
use Illuminate\Database\Seeder;
use App\models\Solutions\AdditionDot;
use App\models\AdditionDot as CurrentModel;
use App\Traits\Randoms;

class AdditionDotSeeder extends Seeder
{
    use Randoms;
    protected int $minDigits;
    protected int $maxDigits;
    protected int $totalNumbers;
    protected int $decimalPlaces = 0;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quizzes = [];

        $quizzes = array_merge($quizzes, $this->factory('p1-3', 'easy', 100));
        $quizzes = array_merge($quizzes, $this->factory('p1-3', 'medium', 100));
        $quizzes = array_merge($quizzes, $this->factory('p1-3', 'hard', 100));
        $quizzes = array_merge($quizzes, $this->factory('p4-6', 'easy', 100));
        $quizzes = array_merge($quizzes, $this->factory('p4-6', 'medium', 100));
        $quizzes = array_merge($quizzes, $this->factory('p4-6', 'hard', 100));
        $quizzes = array_merge($quizzes, $this->factory('m1-3', 'easy', 100));
        $quizzes = array_merge($quizzes, $this->factory('m1-3', 'medium', 100));
        $quizzes = array_merge($quizzes, $this->factory('m1-3', 'hard', 100));
        // dd($quizzes);
        CurrentModel::insert($quizzes);
    }

    protected function factory(string $level, string $difficulty, int $numItems): array
    {
        $levelId = Level::where('code', $level)->first()->id;
        $difficultyId = Difficulty::where('code', $difficulty)->first()->id;
        $quizzes = [];

        for ($item = 0; $item < $numItems; $item++) {
            $this->setConditions($item,$level);

            $fixNumbers = $this->setFixNumber($difficulty);
            $numbers = [];

            for($i=0;$i<$this->totalNumbers;$i++){
                $length = mt_rand($this->minDigits,$this->maxDigits);
                $number = $this->generateRandomNumber($length,$fixNumbers);

                if($level==='m1-3' && $this->decimalPlaces!==0){
                    $decimalPlaces = mt_rand(0,$this->decimalPlaces);
                    $number /=10**($decimalPlaces); 
                }

                $numbers[] = $number;
            }
            $quizzes[] = [
                'numbers' => json_encode($numbers),
                'level_id' => $levelId,
                'difficulty_id' => $difficultyId
            ];

        }

        return $quizzes;
    }

    private function setFixNumber($difficulty):array{

        if($difficulty==='easy'){
            $fixNumbers = [0,1,2,3,4,5,6];
        }elseif($difficulty==='hard'){
            $fixNumbers=[4,5,6,7,8,9];
        }else{
            $fixNumbers =range(0,9);
        }

        return $fixNumbers;
    }

    private function setConditions(int $item, string $level): void
    {
        if ($level === 'm1-3') {
            $this->setLimitTotalDecimalOfSecondary($item, $level);
        } else {
            $this->setLimitTotalOfPrimary($item, $level);
        }
    }
    private function setLimitTotalOfPrimary(int $item, string $level): void
    {

        if ($item < 30) {
            $this->minDigits = $level === 'p1-3' ? 2 : 3;
            $this->maxDigits = $level === 'p1-3' ? 4 : 5;
            $this->totalNumbers = 3;
        } elseif ($item < 60) {
            $this->minDigits = $level === 'p1-3' ? 3 : 4;
            $this->maxDigits = $level === 'p1-3' ? 5 : 6;
            $this->totalNumbers = 4;
        } else {
            $this->minDigits = $level === 'p1-3' ? 4 : 6;
            $this->maxDigits = $level === 'p1-3' ? 6 : 7;
            $this->totalNumbers = 5;
        }
    }

    private function setLimitTotalDecimalOfSecondary(int $item, string $level): void
    {
        $this->decimalPlaces = 0;

        if ($item < 20) {
            $this->minDigits = 4;
            $this->maxDigits = 6;
            $this->totalNumbers = 4;
        } elseif ($item < 40) {
            $this->minDigits = 5;
            $this->maxDigits = 7;
            $this->totalNumbers = 5;
        } elseif ($item < 60) {
            $this->minDigits = 6;
            $this->maxDigits = 8;
            $this->totalNumbers = 6;
        } elseif ($item < 70) {
            $this->minDigits = 4;
            $this->maxDigits = 6;
            $this->totalNumbers = 4;
            $this->decimalPlaces = 2;
        } elseif ($item < 80) {
            $this->minDigits = 5;
            $this->maxDigits = 7;
            $this->totalNumbers = 5;
            $this->decimalPlaces = 3;
        } else {
            $this->minDigits = 6;
            $this->maxDigits = 8;
            $this->totalNumbers = 6;
            $this->decimalPlaces = 3;
        }
    }
}
