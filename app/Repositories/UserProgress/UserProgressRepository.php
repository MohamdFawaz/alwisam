<?php

namespace App\Repositories\UserProgress;

use App\Models\Setting;
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
            $progress = $query->first();
        if($progress){
            return  $this->getCurrentQuestionIndex($exams_list,$progress);
        }
    }

    public function getCurrentQuestionIndex($exams,$progress){
        return array_search($progress->question_id,array_column($exams,'id'));
    }

    public function updateOrCreate($input){
        return UserProgress::updateOrCreate(
            [
                'user_id' => $input['user_id'],
                'exam_id' => $input['exam_id']
            ],
            [
                'question_id' => $input['question_id']
            ]
        );

    }

}