<?php

namespace App\Http\Controllers;

use App\Models\Answers\AdditionQuiz;
use App\Models\Answers\DivisionQuiz;
use App\Models\Answers\MultiplicationQuiz;
use App\Models\Answers\SubtractionQuiz;
use App\Models\Difficulty;
use App\Models\Level;
use App\Models\Method;
use App\Models\Operation;
use Illuminate\Http\Request;

class VedicMathController extends Controller
{
    //
    public function index(string $type = "")
    {
        $difficulties = Difficulty::select('code', 'explain')->get();
        $levels = Level::select('code', 'explain')->get();
        $methods = Method::select('code', 'explain')->get();
        $operations = Operation::select('code', 'explain')->get();
        return view('vedics.index', compact('difficulties', 'levels', 'methods', 'operations', 'type'));
    }

    public function navigate(Request $request)
    {
        $level = $request->get('level');
        $operation = $request->get('operation');
        $difficulty = $request->get('difficulty');

        switch ($operation) {
            case 'addition':
                return $this->addition($level, $difficulty);
                break;
            case 'subtraction':
                return $this->subtraction($level, $difficulty);
                break;
            case 'multiplication':
                return $this->multiplication($level, $difficulty);
                break;
            case 'division':
                return $this->division($level, $difficulty);
                break;
            default:
                return abort(404);
        }
        // return $this->subtraction($level, $difficulty);
    }

    public function addition($level, $difficulty)
    {
        $levelTitle = Level::where('code', $level)->value('explain');
        $difficultyTitle = Difficulty::where('code', $difficulty)->value('explain');
        $additionQuiz = new AdditionQuiz($level, $difficulty);
        $quizzes = $additionQuiz->getQuizzes();
        return view('vedics.answers.addition', compact('quizzes', 'levelTitle', 'difficultyTitle'));
    }

    public function subtraction($level, $difficulty)
    {
        $levelTitle = Level::where('code', $level)->value('explain');
        $difficultyTitle = Difficulty::where('code', $difficulty)->value('explain');
        $subtractionQuiz = new SubtractionQuiz($level, $difficulty);
        $quizzes = $subtractionQuiz->getQuizzes();
        return view('vedics.answers.subtraction', compact('quizzes', 'levelTitle', 'difficultyTitle'));
    }

    public function multiplication($level,$difficulty){
        $levelTitle = Level::where('code', $level)->value('explain');
        $difficultyTitle = Difficulty::where('code', $difficulty)->value('explain');
        $multiplicationQuiz = new MultiplicationQuiz($level, $difficulty);
        $quizzes = $multiplicationQuiz->getQuizzes();
        return view('vedics.answers.multiplication', compact('quizzes', 'levelTitle', 'difficultyTitle'));
    }

    public function division($level,$difficulty){
        $levelTitle = Level::where('code', $level)->value('explain');
        $difficultyTitle = Difficulty::where('code', $difficulty)->value('explain');
        $divisionQuiz = new DivisionQuiz($level, $difficulty);
        $quizzes = $divisionQuiz->getQuizzes();
        return view('vedics.answers.division', compact('quizzes', 'levelTitle', 'difficultyTitle'));
    }
}
