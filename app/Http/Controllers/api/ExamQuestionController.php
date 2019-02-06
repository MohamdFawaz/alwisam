<?php

namespace App\Http\Controllers\api;

use App\Repositories\ExamQuestion\ExamQuestionRepository;
use Illuminate\Http\Request;


class ExamQuestionController extends APIController
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
    public function __construct(ExamQuestionRepository $repository, Request $request)
    {
        $this->repository = $repository;
        $this->setLang('ar');
        $request->headers->set('Accept', 'application/json');
    }


    public function listQuestion($exam_id){
        $data = $this->repository->getAllExamQuestions($exam_id);
        return $this->respond(trans('messages.question.list'),$data);
    }


}
