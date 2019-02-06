<?php

namespace App\Repositories\ExamCode;

use App\Models\ExamCode;
use App\Repositories\BaseRepository;


/**
* Class NotificationRepository.
*/
class ExamCodeRepository extends BaseRepository
{

/**
* related model of this repository.
*
* @var object
*/
    public $model;


    public function __construct(ExamCode $model)
    {
        $this->model = $model;
    }



    public function create($input){
        if(ExamCode::create($input)){
            return true;
        }
        return false;
    }

    public function getAll(){
        if($exams = ExamCode::get()){
            return $exams;
        }
        return false;
    }


}