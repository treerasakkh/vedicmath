<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Solutions\DivisionParavart;

class DivisionParavartQuizTest extends TestCase
{
    /**
     * A basic unit test example.
     */

    public function testNumberOfItems(){
        $level = 'm1-3';
        $difficulty ='easy';
        $numItems = 4;
        $divisonParavart = new DivisionParavart($level, $difficulty);
        $result = count($divisonParavart->get($numItems));
        $this->assertEquals($numItems,$result);
    }

    public function testDividenGreaterThanDivisor(){
        $level = 'm1-3';
        $difficulty ='easy';
        $divisonParavart = new DivisionParavart($level, $difficulty);
        $divisonParavart->defineNumberRange();
        $quiz = $divisonParavart->generateQuiz();
        $dividend = $quiz->dividend;
        $divisor=$quiz->divisor;
        $answer = $quiz->answer;

        $this->assertGreaterThan($divisor,$dividend);
    }

}
