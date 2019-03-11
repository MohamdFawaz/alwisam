<?php

namespace App\Repositories\ExamQuestion;

use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Repositories\QuestionHint\QuestionHintRepository;
use App\Repositories\BaseRepository;


/**
* Class ExamQuestionRepository.
*/
class ExamQuestionRepository extends BaseRepository
{

/**
* related model of this repository.
*
* @var object
*/
    public $model;
    public $questionHitRepository;


    public function __construct(ExamQuestion $model, QuestionHintRepository $questionHitRepository)
    {
        $this->model = $model;
        $this->questionHitRepository = $questionHitRepository;
    }



    public function create($input){
        if(ExamQuestion::create($input)){
            return true;
        }
        return false;
    }

    public function getAllExamQuestions($exam_id){
        $questions = ExamQuestion::whereHas('answers')->where('exam_id',$exam_id)->get();
        return $this->getAllQuestionDetails($questions);

    }


    public function getAllQuestionDetails($questions){
        $question_item = [];
        $question_list = [];
        foreach ($questions as $question){
            $question_item['id'] = $question->id;
            $question_item['question_text'] = $question->description;
            $question_item['answers'] = $this->getAllAnswers($question->answers);
            $question_item['hint'] = $this->questionHitRepository->getHintByQuestionID($question->id);
            $question_list[] = $question_item;
        }
        return $question_list;
    }

    public function getAllAnswers($answers){
        $answer_item = [];
        $answer_list = [];
        foreach ($answers as $answer){
            $answer_item['id'] = $answer->id;
            $answer_item['answer_text'] = $answer->answer_text;
            $answer_item['is_correct'] = $answer->is_correct;
            $answer_list[] = $answer_item;
        }
        return $answer_list;
    }


    public function getAll(){
        if($exams = ExamQuestion::whereHas('exam')->get()){
            return $exams;
        }
        return false;
    }


}