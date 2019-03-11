<?php

namespace App\Repositories\ExamType;

use App\Models\ExamType;
use App\Repositories\BaseRepository;


/**
* Class NotificationRepository.
*/
class ExamTypeRepository extends BaseRepository
{

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

    public function getAll()
    {
        return ExamType::sort()->get();
    }

}