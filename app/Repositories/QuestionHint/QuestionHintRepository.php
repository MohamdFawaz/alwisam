<?php

namespace App\Repositories\QuestionHint;

use App\Models\QuestionHint;
use App\Repositories\BaseRepository;


/**
* Class ExamQuestionRepository.
*/
class QuestionHintRepository extends BaseRepository
{

/**
* related model of this repository.
*
* @var object
*/
    public $model;


    public function __construct(QuestionHint $model)
    {
        $this->model = $model;
    }



    public function create($input){
        if(QuestionHint::create($input)){
            return true;
        }
        return false;
    }

    public function getHintByQuestionID($question_id){
        return $this->getHintDetails(QuestionHint::where('question_id',$question_id)->first());
    }

    public function getHintDetails($hint){
        //$hit_item['id'] = ($hint->id) ?? "";
        $hit_item['hint_text'] = ($hint->hint_text) ?? "";
        return $hit_item;
    }



}