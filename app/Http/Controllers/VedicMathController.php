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
use App\Models\Solutions\AdditionDot;
use App\Models\Solutions\AdditionSubtractionMixed;
use App\Models\Solutions\DivisionNikhilam;
use App\Models\Solutions\DivisionParavart;
use App\Models\Solutions\MultiplicationAligned;
use App\Models\Solutions\MultiplicationBaseShift;
use App\Models\Solutions\MultiplicationVerticalCross;
use App\Models\Solutions\SubtractionDirect;
use App\Models\Solutions\SubtractionNikhilam;
use App\Models\Solutions\SubtractionTen;
use App\Models\Solutions\SubtractionTenNine;
use App\View\Components\Solutions\AdditionDot as SolutionsAdditionDot;
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
        $method = $request->get('method');

        if (isset($operation)) {
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
        }

        if (isset($method)) {
            switch ($method) {
                case 'addition_dot':
                    return $this->addition_dot($level, $difficulty);
                    break;
                case 'subtraction_ten':
                    return $this->subtraction_ten($level, $difficulty);
                    break;
                case 'subtraction_ten_nine':
                    return $this->subtraction_ten_nine($level, $difficulty);
                    break;
                case 'subtraction_direct':
                    return $this->subtraction_direct($level, $difficulty);
                    break;
                case 'subtraction_nikhilam':
                    return $this->subtraction_nikhilam($level, $difficulty);
                    break;
                case 'addition_subtraction_mixed':
                    return $this->addition_subtraction_mixed($level, $difficulty);
                    break;
                case 'multiplication_aligned':
                    return $this->multiplication_aligned($level, $difficulty);
                    break;
                case 'multiplication_vertical_cross':
                    return $this->multiplication_vertical_cross($level, $difficulty);
                    break;
                case 'multiplication_base_shift':
                    return $this->multiplication_base_shift($level, $difficulty);
                    break;
                case 'division_nikhilam':
                    return $this->division_nikhilam($level, $difficulty);
                    break;
                case 'division_paravart':
                    return $this->division_paravart($level, $difficulty);
                    break;
                default:
                    return abort(404);
            }
        }
        // return $this->subtraction($level, $difficulty);
    }

    ################## แบบเติมคำตอบ
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

    public function multiplication($level, $difficulty)
    {
        $levelTitle = Level::where('code', $level)->value('explain');
        $difficultyTitle = Difficulty::where('code', $difficulty)->value('explain');
        $multiplicationQuiz = new MultiplicationQuiz($level, $difficulty);
        $quizzes = $multiplicationQuiz->getQuizzes();
        return view('vedics.answers.multiplication', compact('quizzes', 'levelTitle', 'difficultyTitle'));
    }

    public function division($level, $difficulty)
    {
        $levelTitle = Level::where('code', $level)->value('explain');
        $difficultyTitle = Difficulty::where('code', $difficulty)->value('explain');
        $divisionQuiz = new DivisionQuiz($level, $difficulty);
        $quizzes = $divisionQuiz->getQuizzes();
        return view('vedics.answers.division', compact('quizzes', 'levelTitle', 'difficultyTitle'));
    }

    ######################## แบบแสดงวิธีทำ #############################
    public function addition_dot($level, $difficulty)
    {
        $levelTitle = Level::where('code', $level)->value('explain');
        $difficultyTitle = Difficulty::where('code', $difficulty)->value('explain');
        $additionQuiz = new AdditionDot($level, $difficulty);
        $quizzes = $additionQuiz->get(30);
        return view('vedics.solutions.addition-dot', compact('quizzes', 'levelTitle', 'difficultyTitle'));
    }

    public function subtraction_ten($level, $difficulty)
    {
        $levelTitle = Level::where('code', $level)->value('explain');
        $difficultyTitle = Difficulty::where('code', $difficulty)->value('explain');
        $subtractionQuiz = new SubtractionTen($level, $difficulty);
        $quizzes = $subtractionQuiz->get(8);
        return view('vedics.solutions.subtraction-ten', compact('quizzes', 'levelTitle', 'difficultyTitle'));
    }

    public function subtraction_ten_nine($level, $difficulty)
    {
        $levelTitle = Level::where('code', $level)->value('explain');
        $difficultyTitle = Difficulty::where('code', $difficulty)->value('explain');
        $subtractionQuiz = new SubtractionTenNine($level, $difficulty);
        $quizzes = $subtractionQuiz->get(8);
        return view('vedics.solutions.subtraction-ten-nine', compact('quizzes', 'levelTitle', 'difficultyTitle'));
    }

    public function subtraction_direct($level, $difficulty)
    {
        $levelTitle = Level::where('code', $level)->value('explain');
        $difficultyTitle = Difficulty::where('code', $difficulty)->value('explain');
        $subtractionQuiz = new SubtractionDirect($level, $difficulty);
        $quizzes = $subtractionQuiz->get(8);
        return view('vedics.solutions.subtraction-direct', compact('quizzes', 'levelTitle', 'difficultyTitle'));
    }

    public function subtraction_nikhilam($level, $difficulty)
    {
        $levelTitle = Level::where('code', $level)->value('explain');
        $difficultyTitle = Difficulty::where('code', $difficulty)->value('explain');
        $subtractionQuiz = new SubtractionNikhilam($level, $difficulty);
        $quizzes = $subtractionQuiz->get(8);
        return view('vedics.solutions.subtraction-nikhilam', compact('quizzes', 'levelTitle', 'difficultyTitle'));
    }

    public function addition_subtraction_mixed($level,$difficulty){
        $levelTitle = Level::where('code', $level)->value('explain');
        $difficultyTitle = Difficulty::where('code', $difficulty)->value('explain');
        $additionSubtractionQuiz = new AdditionSubtractionMixed($level, $difficulty);
        $quizzes = $additionSubtractionQuiz->get(8);

        // return $quizzes;
        return view('vedics.solutions.addition-subtraction-mixed', compact('quizzes', 'levelTitle', 'difficultyTitle'));
    }

    public function multiplication_aligned($level, $difficulty){
    
        $levelTitle = Level::where('code', $level)->value('explain');
        $difficultyTitle = Difficulty::where('code', $difficulty)->value('explain');
        $multiplicationQuiz = new MultiplicationAligned($level, $difficulty);
        $quizzes = $multiplicationQuiz->get(6);
        return view('vedics.solutions.multiplication-aligned', compact('quizzes', 'levelTitle', 'difficultyTitle'));
    }

    public function multiplication_vertical_cross($level, $difficulty){
    
        $levelTitle = Level::where('code', $level)->value('explain');
        $difficultyTitle = Difficulty::where('code', $difficulty)->value('explain');
        $multiplicationQuiz = new MultiplicationVerticalCross($level, $difficulty);
        $quizzes = $multiplicationQuiz->get(8);
        return view('vedics.solutions.multiplication-vertical-cross', compact('quizzes', 'levelTitle', 'difficultyTitle'));
    }

    public function multiplication_base_shift($level, $difficulty){
        $levelTitle = Level::where('code', $level)->value('explain');
        $difficultyTitle = Difficulty::where('code', $difficulty)->value('explain');
        $multiplicationQuiz = new MultiplicationBaseShift($level, $difficulty);
        $quizzes = $multiplicationQuiz->get(6);
        return view('vedics.solutions.multiplication-base-shift', compact('quizzes', 'levelTitle', 'difficultyTitle'));
    }

    public function division_nikhilam($level, $difficulty){
        $levelTitle = Level::where('code', $level)->value('explain');
        $difficultyTitle = Difficulty::where('code', $difficulty)->value('explain');
        $divisionQuiz = new DivisionNikhilam($level, $difficulty);
        $quizzes = $divisionQuiz->get(4);
        return view('vedics.solutions.division-nikhilam', compact('quizzes', 'levelTitle', 'difficultyTitle'));
    }

    public function division_paravart($level, $difficulty){
        $levelTitle = Level::where('code', $level)->value('explain');
        $difficultyTitle = Difficulty::where('code', $difficulty)->value('explain');
        $divisionQuiz = new DivisionParavart($level, $difficulty);
        $quizzes = $divisionQuiz->get(4);
        $quizzes = array_chunk($quizzes,2);
        return view('vedics.solutions.division-paravart', compact('quizzes', 'levelTitle', 'difficultyTitle'));
    }
}
