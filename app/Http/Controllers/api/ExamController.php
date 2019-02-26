<?php

namespace App\Http\Controllers\api;

use App\Models\Exam;
use App\Repositories\Exam\ExamRepository;
use App\Repositories\ExamCode\ExamCodeRepository;
use Illuminate\Http\Request;


class ExamController extends APIController
{
    protected $repository;
    protected $examCodeRepository;

    /**
     * __construct.
     *
     * @param $repository
     * @param $request
     * @param $tempUserRepository
     * @param $socialLoginRepository
     */
    public function __construct(ExamRepository $repository,ExamCodeRepository $examCodeRepository, Request $request)
    {
        $this->repository = $repository;
        $this->examCodeRepository= $examCodeRepository;
        $this->setLang('ar');
        $request->headers->set('Accept', 'application/json');
    }
    /* deprecated */
    public function listFree($category_id)
    {
        $data = $this->repository->getFreeExams($category_id);
        return $this->respond(trans('messages.exam.list'),$data);
    }


    public function list($category_id,$code)
    {
        if($code){
            $data = $this->repository->getCodeExams($category_id,$code);
        }else{
            $data = $this->repository->getFreeExams($category_id);
        }
        return $this->respond(trans('messages.exam.list'),$data);
    }


    public function store(Request $request)
    {

//        $exam = $this->repository->create($request->all());
        $exam = $this->examCodeRepository->create($request->all());
        return $this->respond(trans('messages.exam_type.list'),$exam);
    }





}
