<?php

namespace App\Http\Controllers\api;

use App\Repositories\ExamQuestion\ExamQuestionRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\UserProgress\UserProgressRepository;
use Illuminate\Http\Request;


class ExamQuestionController extends APIController
{
    protected $repository;
    protected $userProgressRepository;

    /**
     * __construct.
     * @param $request
     * @param $repository
     */
    public function __construct(ExamQuestionRepository $repository,UserProgressRepository $userProgressRepository, Request $request)
    {
        $this->repository = $repository;
        $this->userProgressRepository = $userProgressRepository;
        $this->setLang('ar');
    }


    public function listQuestion($exam_id,$user_id){
        $exams_list = $this->repository->getAllExamQuestions($exam_id);
        $data['current_question_index'] = $this->userProgressRepository->getUserProgressByUserID($user_id,$exams_list);
        $data['questions'] = $exams_list;
        return $this->respond(trans('messages.question.list'),$data);
    }


}
