<?php

namespace App\Http\Controllers\api;

use App\Models\ExamType;
use Illuminate\Http\Request;


class ExamTypeController extends APIController
{
    protected $repository;

    /**
     * __construct.
     *
     * @param $repository
     * @param $request
     * @param $tempUserRepository
     * @param $socialLoginRepository
     */
    public function __construct(Request $request)
    {
        $this->setLang('ar');
        $request->headers->set('Accept', 'application/json');
    }
    /**
     * Log the user in.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($category_id)
    {
        $examType = ExamType::get();
        return $this->respond(trans('messages.exam_type.list'),$examType);
    }


    public function store(Request $request)
    {
        $examType = ExamType::create($request->all());
        return $this->respond(trans('messages.exam_type.list'),$examType);
    }





}
