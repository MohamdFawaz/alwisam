<?php

namespace App\Repositories\Exam;

use App\Models\Answer;
use App\Models\Exam;
use App\Models\ExamCode;
use App\Models\ExamQuestion;
use App\Models\QuestionAnswer;
use App\Models\QuestionHint;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;


/**
* Class NotificationRepository.
*/
class ExamRepository extends BaseRepository
{

/**
* related model of this repository.
*
* @var object
*/
    public $model;


    public function __construct(Exam $model)
    {
        $this->model = $model;
    }



    public function create($input){
        if(Exam::create($input)){
            return true;
        }
        return false;
    }

    public function createWCode($input){
        DB::transaction(function() use ($input){
            $newExam = Exam::create([
                'title' => $input['title'],
                'category_id' => $input['category_id'],
                'has_code' => ($input['has_code']) ?? 0,
                'status' => 1
            ]);
            if(isset($input['has_code'])){
                ExamCode::craete([
                   'exam_id' => $newExam->id,
                    'code' => $input['code']
                ]);
            }
        });
        return true;
    }

    public function getAll(){
        if($exams = Exam::get()){
            return $exams;
        }
        return false;
    }

    public function getFreeExams($category_id){
        $exams = Exam::whereStatus(1)->whereHas('questions')->whereHasCode(0)->whereCategoryId($category_id)->get();
        return $this->getAllExamsDetail($exams);
    }

    public function getCodeExams($category_id,$code){
        $exams = Exam::whereHas('code',function ($query) use ($code){
            $query->where('code', $code);
        })->whereStatus(1)->whereHas('questions')->whereHasCode(1)->whereCategoryId($category_id)->get();
        return $this->getAllExamsDetail($exams);
    }

    public function getExams()
    {
        $exams = Exam::get();
        return $exams;
    }

    public function getAllExamsDetail($exams)
    {
        $exam_item = [];
        $exam_list = [];
        foreach ($exams as $exam) {
            $exam_item['id'] = $exam->id;
            $exam_item['title'] = $exam->title;
            $exam_list[] = $exam_item;
        }
        return $exam_list;
    }

    public function getById($exam_id)
    {
        return Exam::findOrFail($exam_id);
    }

    public function delete($exam_id)
    {
        $exam = Exam::whereId($exam_id)->delete();
        return true;
    }

    public function flushCode($exam_id)
    {
       return ExamCode::where('exam_id',$exam_id)->delete();
    }

    public function addCode($exam_id,$code)
    {
        return ExamCode::create([
            'exam_id' => $exam_id,
            'code' => $code
        ]);
    }

    protected function checkCorrect($string,$word)
    {
        if (function_exists('grapheme_strpos')) {
            $pos = grapheme_strpos($string, $word);
        } elseif (function_exists('mb_strpos')) {
            $pos = mb_strpos($string, $word);
        } else {
            $pos = stripos($string, $word);
        }
        return $pos;
    }

    protected function split($answer)
    {
        $word = preg_split('//u', $answer, null, PREG_SPLIT_NO_EMPTY);
        return $word[0];
    }

    public function addQuestionsWAnswerImport($exam_id,$questions)
    {
        foreach ($questions as $question) {

            DB::transaction(function () use ($question,$exam_id) {
                $newQuestion = ExamQuestion::create([
                    'exam_id' => $exam_id,
                    'description' => $question['alsoeal']
                ]);
                $answers =
                    [
                        [
                        'question_id' => $newQuestion->id,
                        'answer_text' => $question['ajab_a'],
                        'is_correct'  => ($question['rkm_alejab'] == $this->split($question['ajab_a'])) ? 1 : 0
                        ],
                        [
                            'question_id' => $newQuestion->id,
                            'answer_text' => $question['ajab_b'],
                            'is_correct'  => ($question['rkm_alejab'] == $this->split($question['ajab_b'])) ? 1 : 0
                        ],
                        [
                            'question_id' => $newQuestion->id,
                            'answer_text' => $question['ajab_j'],
                            'is_correct'  => ($question['rkm_alejab'] == $this->split($question['ajab_j'])) ? 1 : 0
                        ],
                        [
                            'question_id' => $newQuestion->id,
                            'answer_text' => $question['ajab_d'],
                            'is_correct'  => ($question['rkm_alejab'] == $this->split($question['ajab_d'])) ? 1 : 0
                        ]
                    ];
                Answer::insert($answers);
                QuestionHint::create([
                    'question_id' => $newQuestion->id,
                    'hint_text' => $question['alaalak']
                ]);
            });
        }
    }


    public function update($exam_id,$input)
    {
        $exam = $this->getById($exam_id);
        $exam->title = $input['title'];
        $exam->category_id = $input['category_id'];
        $exam->save();
        if(isset($input['has_code'])){
            $this->flushCode($exam_id);
            $this->addCode($exam_id,$input['code']);
        }
        return true;
    }

}