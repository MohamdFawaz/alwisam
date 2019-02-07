<?php

namespace App\Http\Controllers\api;

use App\Repositories\Notification\NotificationRepository;
use Illuminate\Http\Request;


class NotificationController extends APIController
{

    protected $repository;


    public function __construct(NotificationRepository $repository)
    {
        $this->repository = $repository;
        $this->setLang('ar');
    }

    public function listNotification($user_id = null){
         $notifications = $this->repository->getNotification($user_id);
         return $this->respond(trans('messages.notification.list'),$notifications);
    }
}
