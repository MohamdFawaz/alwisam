<?php

namespace App\Repositories\Suggestion;

use App\Models\Setting;
use App\Models\Suggestion;
use App\Models\UserProgress;
use App\Repositories\BaseRepository;


/**
* Class ProgressRepository.
*/
class SuggestionRepository extends BaseRepository
{

/**
* related model of this repository.
*
* @var object
*/
    public $model;


    public function __construct(Suggestion $model)
    {
        $this->model = $model;
    }

    public function create($input){
        $suggestion = Suggestion::create($input);
        return $suggestion;
    }

}