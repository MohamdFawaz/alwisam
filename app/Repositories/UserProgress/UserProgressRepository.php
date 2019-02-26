<?php

namespace App\Repositories\UserProgress;

use App\Models\Setting;
use App\Models\User;
use App\Models\UserProgress;
use App\Repositories\BaseRepository;


/**
* Class ProgressRepository.
*/
class UserProgressRepository extends BaseRepository
{

/**
* related model of this repository.
*
* @var object
*/
    public $model;


    public function __construct(UserProgress $model)
    {
        $this->model = $model;
    }

    public function getUserProgressByUserID($user_id,$exams_list,$exam_id = null){
        $query = UserProgress::where('user_id',$user_id);
            if($exam_id){
                $query->where('exam_id',$exam_id)->first();
            }
            $progress = $query->latest()->first();
        if($progress){
            return  $this->getCurrentQuestionIndex($exams_list,$progress);
        }
    }

    public function getCurrentQuestionIndex($exams,$progress){
        return array_search($progress->question_id,array_column($exams,'id'));
    }

    public function getCorrectAnswerCount($user_id,$exam_id){
        return UserProgress::where('user_id',$user_id)->where('exam_id',$exam_id)->where('is_correct',1)->count();
    }

    public function getWrongAnswerCount($user_id,$exam_id){
        return UserProgress::where('user_id',$user_id)->where('exam_id',$exam_id)->where('is_correct',0)->count();
    }

    public function updateOrCreate($input){
        return UserProgress::firstOrCreate(
            [
                'user_id' => $input['user_id'],
                'exam_id' => $input['exam_id'],
                'question_id' => $input['question_id'],
                'is_correct' => $input['is_correct']
            ]
        );

    }
    public function deleteProgress($user_id,$exam_id){
        UserProgress::where('user_id',$user_id)->where('exam_id',$exam_id)->delete();
        return true;
    }

}