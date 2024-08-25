<?php

namespace App\Models\Solutions;

use App\Traits\Randoms;
use App\View\Components\Solutions\AdditionDot as AddDot;

class AdditionDot extends SolutionAbstract
{
    use Randoms;

    protected int $decimalPlaces;
    protected int $minDigits;
    protected int $maxDigits;
    protected int $randDigits;
    protected int $totalNumber;
    protected array $fixNumbers;
    protected int $order;

    public function __construct(string $level, string $difficulty)
    {
        $this->level = $level;
        $this->difficulty = $difficulty;
        $this->setInitial();
    }

    protected function setInitial(): void
    {
        $this->setFixNumber();
        $this->decimalPlaces = 0;
    }

    protected function setMinMaxByStep(int $order): void
    {
        switch ($order) {
            case 1:
                $this->setStep1();
                break;
            case 2:
                $this->setStep2();
                break;
            case 3:
                $this->setStep3();
                break;
            case 4:
                $this->setStep4();
                break;
            case 5:
                $this->setStep5();
                break;
            default:
                $this->setStep6();
        }
    }

    protected function setStep1(): void
    {
        switch ($this->level) {
            case 'p4-6':
                $this->setConditions(3, 5, 3);
                break;
            case 'm1-3':
                $this->setConditions(4, 6, 4);
                $this->setDecimalPlaces(0);
                break;
            default:
                $this->setConditions(2, 4, 3);
        }
    }

    protected function setStep2(): void
    {
        switch ($this->level) {
            case 'p4-6':
                $this->setConditions(3, 5, 3);
                break;
            case 'm1-3':
                $this->setConditions(4, 6, 4);
                $this->setDecimalPlaces(2);
                break;
            default:
                $this->setConditions(2, 4, 3);
        }
    }

    protected function setStep3(): void
    {
        switch ($this->level) {
            case 'p4-6':
                $this->setConditions(4, 6, 4);
                break;
            case 'm1-3':
                $this->setConditions(5, 7, 5);
                $this->setDecimalPlaces(0);
                break;
            default:
                $this->setConditions(3, 5, 4);
        }
    }

    protected function setStep4(): void
    {
        switch ($this->level) {
            case 'p4-6':
                $this->setConditions(5, 7, 5);
                break;
            case 'm1-3':
                $this->setConditions(5, 7, 5);
                $this->setDecimalPlaces(3);
                break;
            default:
                $this->setConditions(3, 5, 4);
        }
    }

    protected function setStep5(): void
    {
        switch ($this->level) {
            case 'p4-6':
                $this->setConditions(4, 6, 4);
                break;
            case 'm1-3':
                $this->setConditions(6, 8, 6);
                $this->setDecimalPlaces(0);
                break;
            default:
                $this->setConditions(4, 6, 5);
        }
    }

    protected function setStep6(): void
    {
        switch ($this->level) {
            case 'p4-6':
                $this->setConditions(4, 6, 4);
                break;
            case 'm1-3':
                $this->setConditions(6, 8, 6);
                $this->setDecimalPlaces(3);
                break;
            default:
                $this->setConditions(4, 6, 5);
        }
    }

    protected function setConditions(int $min, int $max, int $totalNumber): void
    {
        $this->minDigits = $min;
        $this->maxDigits = $max;
        $this->totalNumber = $totalNumber;

        $this->randDigits = mt_rand($min, $max);
    }


    protected function setFixNumber(): void
    {
        $this->fixNumbers = $this->difficulty === 'easy'
            ? [0, 1, 2, 3, 4, 5]
            : ($this->difficulty === 'hard' ? [4, 5, 6, 7, 8, 9] : range(0, 9));
    }

    public function setDecimalPlaces(int $decimalPlaces): void
    {
        $this->decimalPlaces = $decimalPlaces;
    }

    public function get($numItems = 1): array
    {
        $quizzes = [];

        for ($i = 0; $i < $numItems; $i++) {

            $this->setOrder($i);
            $this->setMinMaxByStep($this->order, true);
            $numbers = $this->getNumbers();

            $quizzes[] = (object)[
                'numbers' =>  array_map(fn ($num) => number_format($num, $this->decimalPlaces, '.', ''), $numbers),
                'answer' => $this->dynamicNumberFormat(array_sum($numbers))
            ];
        }

        return $quizzes;
    }

    protected function setOrder(int $number, bool $isCalculated = false): void
    {
        $this->order = $isCalculated ? (1 + floor($number / 5)) : $number;
    }

    protected function getNumbers(): array
    {
        do {
            $numbers = array_map(function () {
                $number = $this->generateRandomNumber($this->randDigits, $this->fixNumbers);
                return $this->decimalPlaces === 0 ? $number : $number / 10 ** mt_rand(1, $this->decimalPlaces);
            }, range(0, $this->totalNumber - 1));

            $addDot = new AddDot($numbers, false, 0);
            $invalid = $addDot->numDots < 2;
        } while ($invalid);

        return $numbers;
    }

    private function dynamicNumberFormat($number)
    {
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
