<?php

namespace App\Http\Controllers\api;

use App\Repositories\Notification\NotificationRepository;
use App\Repositories\UsefulLink\UsefulLinkRepository;
use Illuminate\Http\Request;


class UsefulLinkController extends APIController
{

    protected $repository;


    public function __construct(UsefulLinkRepository $repository)
    {
        $this->repository = $repository;
        $this->setLang('ar');
    }

    public function listLinks(){
         $links = $this->repository->getAll();
         return $this->respond(trans('messages.link.list'),$links);
    }
}
