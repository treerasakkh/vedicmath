<?php

namespace App\Models\Answers;

class AdditionQuiz extends Addition
{
    public function __construct($level, $difficulty){
        $this->level = $level;
        $this->difficulty = $difficulty;
    }

    public function getQuizzes():array
    {
       
        switch ($this->level) {
            case 'p4-6':
                $numDigits = (object)[
                    'set1' => (object)[
                        'min' => 3, 'max' => 5, 'total' => 3, 'decimalPlaces' => 0
                    ],
                    'set3' => (object)[
                        'min' => 4, 'max' => 6, 'total' => 4, 'decimalPlaces' => 0
                    ],
                    'set5' => (object)[
                        'min' => 6, 'max' => 7, 'total' => 5, 'decimalPlaces' => 0
                    ],
                ];
                break;
            case 'm1-3':
                $numDigits = (object)[
                    'set1' => (object)[
                        'min' => 4, 'max' => 6, 'total' => 4, 'decimalPlaces' => 0
                    ],
                    'set2' => (object)[
                        'min' => 4, 'max' => 6, 'total' => 4, 'decimalPlaces' => 2
                    ],
                    'set3' => (object)[
                        'min' => 5, 'max' => 7, 'total' => 5, 'decimalPlaces' => 0
                    ],
                    'set4' => (object)[
                        'min' => 5, 'max' => 7, 'total' => 5, 'decimalPlaces' => 3
                    ],
                    'set5' => (object)[
                        'min' => 6, 'max' => 8, 'total' => 6, 'decimalPlaces' => 0
                    ],
                    'set6' => (object)[
                        'min' => 6, 'max' => 8, 'total' => 6, 'decimalPlaces' => 3
                    ],
                ];

                break;
            default:
                $numDigits = (object)[
                    'set1' => (object)[
                        'min' => 2, 'max' => 4, 'total' => 3, 'decimalPlaces' => 0
                    ],
                    'set3' => (object)[
                        'min' => 3, 'max' => 5, 'total' => 4, 'decimalPlaces' => 0
                    ],
                    'set5' => (object)[
                        'min' => 4, 'max' => 6, 'total' => 5, 'decimalPlaces' => 0
                    ],
                ];
        }

        if ($this->level !== 'm1-3') {
            $numDigits->set2 = $numDigits->set1;
            $numDigits->set4 = $numDigits->set3;
            $numDigits->set6 = $numDigits->set5;
        }

        $quizzes1 = $this->setMinMaxDigits($numDigits->set1->min, $numDigits->set1->max)
            ->setTotalNumbers($numDigits->set1->total)
            ->setLevel($this->level)
            ->setDifficulty($this->difficulty)
            ->setDecimalPlaces($numDigits->set1->decimalPlaces)
            ->get(5);
        $quizzes2 = $this->setMinMaxDigits($numDigits->set2->min, $numDigits->set2->max)
            ->setTotalNumbers($numDigits->set2->total)
            ->setLevel($this->level)
            ->setDifficulty($this->difficulty)
            ->setDecimalPlaces($numDigits->set2->decimalPlaces)
            ->get(5);
        $quizzes3 = $this->setMinMaxDigits($numDigits->set3->min, $numDigits->set3->max)
            ->setTotalNumbers($numDigits->set3->total)
            ->setLevel($this->level)
            ->setDifficulty($this->difficulty)
            ->setDecimalPlaces($numDigits->set3->decimalPlaces)
            ->get(5);
        $quizzes4 = $this->setMinMaxDigits($numDigits->set4->min, $numDigits->set4->max)
            ->setTotalNumbers($numDigits->set4->total)
            ->setLevel($this->level)
            ->setDifficulty($this->difficulty)
            ->setDecimalPlaces($numDigits->set4->decimalPlaces)
            ->get(5);
        $quizzes5 = $this->setMinMaxDigits($numDigits->set5->min, $numDigits->set5->max)
            ->setTotalNumbers($numDigits->set5->total)
            ->setLevel($this->level)
            ->setDifficulty($this->difficulty)
            ->setDecimalPlaces($numDigits->set5->decimalPlaces)
            ->get(5);
        $quizzes6 = $this->setMinMaxDigits($numDigits->set6->min, $numDigits->set6->max)
            ->setTotalNumbers($numDigits->set6->total)
            ->setLevel($this->level)
            ->setDifficulty($this->difficulty)
            ->setDecimalPlaces($numDigits->set6->decimalPlaces)
            ->get(5);

        return array_merge($quizzes1, $quizzes2, $quizzes3, $quizzes4, $quizzes5, $quizzes6);

    }
}
