<?php

namespace Database\Seeders;

use App\Models\Difficulty;
use App\Models\Level;
use Illuminate\Database\Seeder;
use App\models\Solutions\AdditionSubtractionMixed;
use App\models\AdditionSubtractionMixed as CurrentModel;

class AdditionSubtractionMixedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quizzes = [];

        $quizzes = array_merge($quizzes,$this->factory('p1-3','easy',100));
        $quizzes = array_merge($quizzes,$this->factory('p1-3','medium',100));
        $quizzes = array_merge($quizzes,$this->factory('p1-3','hard',100));
        $quizzes = array_merge($quizzes,$this->factory('p4-6','easy',100));
        $quizzes = array_merge($quizzes,$this->factory('p4-6','medium',100));
        $quizzes = array_merge($quizzes,$this->factory('p4-6','hard',100));
        $quizzes = array_merge($quizzes,$this->factory('m1-3','easy',100));
        $quizzes = array_merge($quizzes,$this->factory('m1-3','medium',100));
        $quizzes = array_merge($quizzes,$this->factory('m1-3','hard',100));
        
        CurrentModel::insert($quizzes);
    }

    protected function factory(string $level, string $difficulty, int $numItems): array
    {
        $levelId = Level::where('code',$level)->first()->id;
        $difficultyId = Difficulty::where('code',$difficulty)->first()->id;
        
        $addSubMixed = new AdditionSubtractionMixed($level, $difficulty);
        $quizzes = collect($addSubMixed->get($numItems));
        
        $quizzes = $quizzes->map(function ($quiz) use ($levelId, $difficultyId) {
            return [
                'numbers' => json_encode($quiz->numbers),
                'level_id'=>$levelId,
                'difficulty_id'=>$difficultyId
            ];
        });

        return $quizzes->toArray();
    }
}
