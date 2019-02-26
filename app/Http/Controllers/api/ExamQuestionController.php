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
        $user_progress = $this->userProgressRepository->getUserProgressByUserID($user_id,$exams_list,$exam_id);
        if($user_progress > count($exams_list)-1){
            $data['current_question_index'] = $user_progress;
        }else{
            $data['current_question_index'] = $user_progress+1;
        }
        $data['correct_answers_count'] = $this->userProgressRepository->getCorrectAnswerCount($user_id,$exam_id);
        $data['wrong_answers_count'] = $this->userProgressRepository->getWrongAnswerCount($user_id,$exam_id);
        $data['questions'] = $exams_list;
        return $this->respond(trans('messages.question.list'),$data);
    }


}
