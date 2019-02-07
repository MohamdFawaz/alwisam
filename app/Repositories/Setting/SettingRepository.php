<?php

namespace App\Repositories\Setting;

use App\Models\Setting;
use App\Repositories\BaseRepository;
use Hamcrest\Core\Set;


/**
* Class NotificationRepository.
*/
class SettingRepository extends BaseRepository
{

/**
* related model of this repositery.
*
* @var object
*/
    public $model;


    public function __construct(Setting $model)
    {
        $this->model = $model;
    }

    public function getSettingByKey($key){
        $value = Setting::where('key',$key)->pluck('value')->first();
        return $value;
    }

    public function create($input){
        if(Setting::create($input)){
            return true;
        }
        return false;
    }

    public function createSocial($input){
        if(Setting::create([
            'key' => 'social_links',
            'value' => json_encode($input['value'])
        ])){
            return true;
        }
        return false;
    }

    public function delete($input){
        if(Setting::destroy($input)){
            return true;
        }
        return false;
    }

}