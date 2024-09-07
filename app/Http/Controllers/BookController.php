<?php

namespace App\Http\Controllers;

use App\Models\AdditionDot;
use App\Models\AdditionSubtractionMixed;
use App\Models\Difficulty;
use App\Models\DivisionNikhilam;
use App\Models\DivisionParavart;
use App\Models\Level;
use App\Models\MultiplicationAligned;
use App\Models\MultiplicationVerticalCross;
use App\Models\MultiplicationBaseShift;
use App\Models\SubtractionDirect;
use App\Models\SubtractionNikhilam;
use App\Models\SubtractionTen;
use App\Models\SubtractionTenNine;
use Illuminate\Database\Eloquent\Collection;

class BookController extends Controller
{

    public function index()
    {
        $levels = Level::all();
        $difficulties = Difficulty::all();
        
        return view('books.index', compact('levels','difficulties'));
    }

    public function test(){
        return view('books.test');
    }

    public function navigator($level, $difficulty)
    {
        $levelLabel = Level::where('code',$level)
                        ->first()
                        ->explain;
        $difficultyLabel = Difficulty::where('code',$difficulty)
                        ->first()
                        ->explain;
        $quizzes = [];
        $quizzes = [
            "subTen"=>$this->getSubTen($level, $difficulty),
            "subTenNine"=>$this->getSubTenNine($level, $difficulty),
            "subDirect"=>$this->getSubDirect($level, $difficulty),
            "subNikhilam"=>$this->getSubNikhilam($level, $difficulty),
            "mulCross"=>$this->getMulCross($level, $difficulty),
            "mulBase"=>$this->getMulBase($level, $difficulty),
            "mulAligned"=>$this->getMulAligned($level, $difficulty),
            "divNikhilam"=>$this->getDivNikhilam($level, $difficulty),
            "divParavart"=>$this->getDivParavart($level, $difficulty),
            "addSubMixed"=>$this->getAddSubMixed($level, $difficulty),
            "addDot"=>$this->getAddDot($level, $difficulty),
        ];
        return view('books.book', compact('quizzes','level','levelLabel','difficultyLabel'));
    }

    protected function getAddSubMixed($level, $difficulty):array
    {
        $collection = AdditionSubtractionMixed::where('level_id', $this->getLevelId($level))
        ->where('difficulty_id', $this->getDifficultyId($difficulty))
        ->get()
        ->map(fn ($q) => json_decode($q->numbers));
    return $collection->toArray();
    }

    protected function getDivParavart($level, $difficulty): array
    {
        $collection = DivisionParavart::select('number1', 'number2')
            ->where('level_id', $this->getLevelId($level))
            ->where('difficulty_id', $this->getDifficultyId($difficulty))
            ->get()
            ->map(fn($q)=>(object)$q);
       
        return $collection->toArray();
    }

    protected function getDivNikhilam($level, $difficulty): array
    {
        $collection = DivisionNikhilam::select('number1', 'number2')
            ->where('level_id', $this->getLevelId($level))
            ->where('difficulty_id', $this->getDifficultyId($difficulty))
            ->get()
            ->map(fn($q)=>(object)$q);
       
        return $collection->toArray();
    }

    protected function getMulAligned($level, $difficulty): array
    {
        $collection = MultiplicationAligned::select('number1', 'number2')
            ->where('level_id', $this->getLevelId($level))
            ->where('difficulty_id', $this->getDifficultyId($difficulty))
            ->get()
            ->map(fn($q)=>(object)$q);
       
        return $collection->toArray();
    }


    protected function getMulBase($level, $difficulty): array
    {
        $collection = MultiplicationBaseShift::select('number1', 'number2')
            ->where('level_id', $this->getLevelId($level))
            ->where('difficulty_id', $this->getDifficultyId($difficulty))
            ->get()
            ->map(fn($q)=>(object)$q);
       
        return $collection->toArray();
    }

    protected function getMulCross($level, $difficulty): array
    {
        $collection = MultiplicationVerticalCross::select('number1', 'number2')
            ->where('level_id', $this->getLevelId($level))
            ->where('difficulty_id', $this->getDifficultyId($difficulty))
            ->get()
            ->map(fn($q)=>(object)$q);
       
        return $collection->toArray();
    }

    protected function getSubNikhilam($level, $difficulty): array
    {
        $collection = SubtractionNikhilam::select('number1', 'number2')
            ->where('level_id', $this->getLevelId($level))
            ->where('difficulty_id', $this->getDifficultyId($difficulty))
            ->get()
            ->map(fn($q)=>(object)$q);
        return $collection->toArray();
    }

    protected function getSubDirect($level, $difficulty): array
    {
        $collection = SubtractionDirect::select('number1', 'number2')
            ->where('level_id', $this->getLevelId($level))
            ->where('difficulty_id', $this->getDifficultyId($difficulty))
            ->get();
        return $collection->toArray();
    }

    protected function getSubTenNine($level, $difficulty): array
    {
        $collection = SubtractionTenNine::select('number1', 'number2')
            ->where('level_id', $this->getLevelId($level))
            ->where('difficulty_id', $this->getDifficultyId($difficulty))
            ->get();
        return $collection->toArray();
    }

    protected function getSubTen($level, $difficulty): array
    {
        $collection = SubtractionTen::select(['number1','number2'])
            ->where('level_id', $this->getLevelId($level))
            ->where('difficulty_id', $this->getDifficultyId($difficulty))
            ->get();
    
        return $collection->toArray();
    }

    protected function getAddDot(string $level, string $difficulty): array
    {
        $collection = AdditionDot::where('level_id', $this->getLevelId($level))
            ->where('difficulty_id', $this->getDifficultyId($difficulty))
            ->get()
            ->map(fn ($q) => json_decode($q->numbers));
        return $collection->toArray();
    }

    protected function getLevelId(string $levelCode): int
    {
        return Level::where('code', $levelCode)->pluck('id')->first();
    }

    protected function getDifficultyId(string $difficultyCode): int
    {
        return Difficulty::where('code', $difficultyCode)->pluck('id')->first();
    }
}
