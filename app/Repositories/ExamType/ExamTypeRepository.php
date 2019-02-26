<?php

namespace App\Repositories\ExamType;

use App\Models\ExamType;
use App\Repositories\BaseRepository;


/**
* Class NotificationRepository.
*/
class ExamTypeRepository extends BaseRepository
{

/**
* related model of this repository.
*
* @var object
*/
    public $model;


    public function __construct(ExamType $model)
    {
        $this->model = $model;
    }



    public function create($input){
        if(ExamCode::create($input)){
            return true;
        }
        return false;
    }

    public function getExamTypeAll(){
        if($types= ExamType::get()){
            foreach ($types as $type){
                $type['image'] = "";
                $type['children'] = [];
            }
            return $types;
        }
        return false;
    }


}