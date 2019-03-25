<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamQuestion;
use App\Repositories\Exam\ExamRepository;
use App\Repositories\ExamQuestion\ExamQuestionRepository;
use App\Imports\QuestionImport;
use Maatwebsite\Excel\Facades\Excel;

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

    public function store(Request $request)
    {
        $newQuestion = $this->repository->createWAnswer($request->all());
        return redirect('admin/questions');
    }

    public function edit($question_id)
    {
        $exams = $this->examRepository->getExams();
        $question = $this->repository->getById($question_id);
        return view('backend.questions.edit',compact('exams','question'));
    }

    public function update($question_id,Request $request)
    {
        $this->repository->updateWAnswer($question_id,$request->all());
        return redirect('admin/questions')->withSuccess('updated successfully');
    }

    public function delete($question_id)
    {
        $this->repository->delete($question_id);
        return redirect('admin/questions');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function import(Request $request)
    {
        $data = Excel::toArray(new QuestionImport($request->exam_id),$request->file('import'));
        return $data ;
    }
}
