<?php

namespace App\Repositories\UsefulLink;

use App\Models\Notification;
use App\Models\Setting;
use App\Models\UsefulLink;
use App\Models\UserProgress;
use App\Repositories\BaseRepository;
use Carbon\Carbon;


/**
* Class ProgressRepository.
*/
class UsefulLinkRepository extends BaseRepository
{

/**
* related model of this repository.
*
* @var object
*/
    public $model;


    public function __construct(UsefulLink $model)
    {
        $this->model = $model;
    }

    public function getAll(){
        $links= UsefulLink::get();
        return $this->getLinkDetails($links);
    }

    public function getLinkDetails($links){
        $link_item = [];
        $link_list = [];
        foreach ($links as $link){
            $link_item['url'] = $link->url;
            $link_list[] = $link_item;
        }
        return $link_list;
    }

}