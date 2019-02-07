<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\User\UpdateProgressRequest;
use App\Repositories\UserProgress\UserProgressRepository;
use Illuminate\Http\Request;

class UserProgressController extends APIController
{

    protected $repository;


    public function __construct(UserProgressRepository $repository, Request $request)
    {
        $this->repository = $repository;
        $this->setLang('ar');
    }

    public function updateUserProgress(UpdateProgressRequest $request){
      $updated = $this->repository->updateOrCreate($request->all());
      if($updated){
          return $this->respondWithMessage(trans('messages.user_progress.updated_successfully'));
      }else{
          return $this->respondWithError(trans('messages.something_went_wrong'));
      }
    }
}
