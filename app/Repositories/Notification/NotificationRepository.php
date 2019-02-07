<?php

namespace App\Repositories\Notification;

use App\Models\Notification;
use App\Models\Setting;
use App\Models\UserProgress;
use App\Repositories\BaseRepository;
use Carbon\Carbon;


/**
* Class ProgressRepository.
*/
class NotificationRepository extends BaseRepository
{

/**
* related model of this repository.
*
* @var object
*/
    public $model;


    public function __construct(Notification $model)
    {
        $this->model = $model;
    }

    public function getNotification($user_id = null){
        $notifications= Notification::where('user_id',$user_id)->orWhere('user_id', 'all')->get();
        return $this->getNotificationDetails($notifications);
    }

    public function getNotificationDetails($notifications){
        $notification_item = [];
        $notification_list = [];
        foreach ($notifications as $notification){
            $notification_item['id'] = $notification->id;
            $notification_item['content'] = $notification->content;
            $notification_item['image'] = $notification->image;
            $notification_item['date'] = Carbon::parse($notification['created_at'])->diffForHumans();
            $notification_list[] = $notification_item;
        }
        return $notification_list;
    }

    public function updateOrCreate($input){
        return UserProgress::updateOrCreate(
            [
                'user_id' => $input['user_id'],
                'exam_id' => $input['exam_id']
            ],
            [
                'question_id' => $input['question_id']
            ]
        );

    }

}