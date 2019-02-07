<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\User\UpdateProgressRequest;
use App\Repositories\Setting\SettingRepository;
use App\Repositories\UserProgress\UserProgressRepository;
use Illuminate\Http\Request;

class SettingController extends APIController
{

    protected $repository;


    public function __construct(SettingRepository $repository)
    {
        $this->repository = $repository;
        $this->setLang('ar');
    }

    public function store(Request $request){
        $setting = $this->repository->createSocial($request->all());
        return $setting;
    }

    public function aboutUs(){
        $aboutUs = $this->repository->getSettingByKey('about_us');
        return $this->respond(trans('messages.setting.about_us'),$aboutUs);
    }

    public function termsAndCondition(){
        $termsAndConditions = $this->repository->getSettingByKey('terms_and_condition');
        return $this->respond(trans('messages.setting.terms_and_condition'),$termsAndConditions);
    }

    public function socialLinks(){
        $socialLinks = $this->repository->getSettingByKey('social_links');

        return $this->respond(trans('messages.setting.social_links'),json_decode($socialLinks));
    }

}
