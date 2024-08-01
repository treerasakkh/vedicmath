<?php

namespace App\Models\Answers;

class DivisionQuiz extends Division
{
    public function __construct($level, $difficulty)
    {
        $this->level = $level;
        $this->difficulty = $difficulty;
    }

    public function getQuizzes(): array
    {

        switch ($this->level) {
            case 'p4-6':
                $numDigits = (object)[
                    'set1' => (object)[
                        'min1' => 3, 'max1' => 4, 'min2' => 2, 'max2' => 3,'hasRemainder'=>true
                    ],
                    'set2' => (object)[
                        'min1' => 4, 'max1' => 5, 'min2' => 2, 'max2' => 4,'hasRemainder'=>true
                    ],
                ];
                break;
            case 'm1-3':
                $numDigits = (object)[
                    'set1' => (object)[
                        'min1' => 4, 'max1' => 5, 'min2' => 2, 'max2' => 3,'hasRemainder'=>true
                    ],
                    'set2' => (object)[
                        'min1' => 4, 'max1' => 6, 'min2' => 3, 'max2' => 4,'hasRemainder'=>true
                    ],
    
                ];

                break;
            default:
                $numDigits = (object)[
                    'set1' => (object)[
                        'min1' => 2, 'max1' => 3, 'min2' => 1, 'max2' => 1,'hasRemainder'=>false
                    ],
                    'set2' => (object)[
                        'min1' => 3, 'max1' => 4, 'min2' => 1, 'max2' => 2,'hasRemainder'=>false
                    ]
                ];
        }

        $quizzes1 = $this->setMinMaxNum1($numDigits->set1->min1, $numDigits->set1->max1)
            ->setMinMaxNum2($numDigits->set1->min2, $numDigits->set1->max2)
            ->setHasRemainder($numDigits->set1->hasRemainder)
            ->setLevel($this->level)
            ->setDifficulty($this->difficulty)
            ->get(10);
            
        $quizzes2 = $this->setMinMaxNum1($numDigits->set2->min1, $numDigits->set2->max1)
            ->setMinMaxNum2($numDigits->set2->min2, $numDigits->set2->max2)
            ->setHasRemainder($numDigits->set2->hasRemainder)
            ->setLevel($this->level)
            ->setDifficulty($this->difficulty)
            ->get(10);

        return array_merge($quizzes1, $quizzes2);
    }
}
