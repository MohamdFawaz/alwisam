<?php

namespace App\Repositories\Exam;

use App\Models\Exam;
use App\Repositories\BaseRepository;


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

    public function getAll(){
        if($exams = Exam::get()){
            return $exams;
        }
        return false;
    }

    public function getFreeExams($category_id){
        $exams = Exam::whereStatus(1)->whereHasCode(0)->whereCategoryId($category_id)->get();
        return $this->getAllExamsDetail($exams);
    }

    public function getCodeExams($category_id,$code){
        $exams = Exam::whereHas('code',function ($query) use ($code){
            $query->where('code', $code);
        })->whereStatus(1)->whereHasCode(1)->whereCategoryId($category_id)->get();
        return $this->getAllExamsDetail($exams);
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



    public function delete($input){
        if(Exam::destroy($input)){
            return true;
        }
        return false;
    }

}