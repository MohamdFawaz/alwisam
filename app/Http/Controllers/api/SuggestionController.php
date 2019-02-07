<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\User\UpdateProgressRequest;
use App\Repositories\Suggestion\SuggestionRepository;
use App\Repositories\UserProgress\UserProgressRepository;
use Illuminate\Http\Request;

class SuggestionController extends APIController
{

    protected $repository;


    public function __construct(SuggestionRepository $repository)
    {
        $this->repository = $repository;
        $this->setLang('ar');
    }

    public function store(Request $request){
        if($this->repository->create($request->all())){
            return $this->respondWithMessage(trans('messages.suggestion.added'));
        }else{
            return $this->respondWithError(trans('messages.something_went_wrong'));
        }
    }
}
