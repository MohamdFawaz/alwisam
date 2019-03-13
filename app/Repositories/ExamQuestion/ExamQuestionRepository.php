<?php

namespace App\Repositories\ExamQuestion;

use App\Models\Answer;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\QuestionAnswer;
use App\Models\QuestionHint;
use App\Repositories\QuestionHint\QuestionHintRepository;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;


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

    public function createWAnswer($input){
        array_pop($input['is_correct']);
        DB::transaction(function() use ($input)
        {
            $newQuestion= ExamQuestion::create([
                'exam_id' => $input['exam_id'],
                'description' => $input['description']
            ]);
            for ($i = 0;$i < count($input['answers']);$i++){
                Answer::create([
                    'answer_text' => $input['answers'][$i],
                    'question_id' => $newQuestion->id,
                    'is_correct' => $input['is_correct'][$i],
                ]);
            }
            QuestionHint::create([
                'question_id' => $newQuestion->id,
                'hint_text' => $input['hint']
            ]);
        });
        return false;
    }


    public function flushAnswers($question_id)
    {
        return Answer::where('question_id',$question_id)->delete();
    }

    public function updateWAnswer($question_id,$input){
        array_pop($input['is_correct']);
        DB::transaction(function() use ($input,$question_id)
        {
            $newQuestion = ExamQuestion::whereId($input['exam_id'])->update(['description' => $input['description']]);

            $this->flushAnswers($question_id);

            for ($i = 0;$i < count($input['answers']);$i++){
                Answer::create([
                    'answer_text' => $input['answers'][$i],
                    'question_id' => $question_id,
                    'is_correct' => $input['is_correct'][$i],
                ]);
            }
            QuestionHint::where('question_id',$question_id)->update(['hint_text' => $input['hint']]);
        });
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

    public function getById($question_id){
        $question = ExamQuestion::with('answers','hint')->whereId($question_id)->first();
        return $question;
    }

    public function delete($question_id){
        return ExamQuestion::where('id',$question_id)->delete();
    }

}