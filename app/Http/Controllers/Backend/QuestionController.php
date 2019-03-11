<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ExamQuestion;
use App\Repositories\Exam\ExamRepository;
use App\Repositories\ExamQuestion\ExamQuestionRepository;

class QuestionController extends Controller
{
    protected $repository;
    protected $examRepository;

    public function __construct(ExamQuestionRepository $repository,ExamRepository $examRepository)
    {
        $this->repository = $repository;
        $this->examRepository = $examRepository;
        app()->setLocale('ar');
    }

    public function index()
    {
        $questions = $this->repository->getAll();
        return view('backend.questions.index',compact('questions'));
    }

    public function create()
    {
        $exams = $this->examRepository->getExams();
        return view('backend.questions.create',compact('exams'));
    }
}
