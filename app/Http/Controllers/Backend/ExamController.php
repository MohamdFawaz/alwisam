<?php

namespace App\Http\Controllers\Backend;

use App\Imports\QuestionImport;
use App\Models\Exam;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Exam\ExamRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExamController extends Controller
{
    protected $repository;
    protected $categoryRepository;

    public function __construct(ExamRepository $repository,CategoryRepository $categoryRepository)
    {
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
        app()->setLocale('ar');
    }

    public function index()
    {
        $exams = $this->repository->getExams();
        return view('backend.exams.index',compact('exams'));
    }

    public function create()
    {
        $categories = $this->categoryRepository->getChildCategory();
        return view('backend.exams.create',compact('categories'));
    }

    public function store(Request $request)
    {
        $this->repository->createWCode($request->all());
        return redirect('admin/exam');
    }

    public function edit($exam_id)
    {
        $categories = $this->categoryRepository->getChildCategory();
        $exam = $this->repository->getById($exam_id);
        return view('backend.exams.edit',compact('categories','exam'));

    }

    public function update($exam_id,Request $request)
    {
        $this->repository->update($exam_id,$request->all());
        return redirect('admin/exam');
    }
    public function delete($exam_id)
    {
        $this->repository->delete($exam_id);
        return redirect('admin/exam');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function import(Request $request)
    {
        $data = Excel::toArray(new QuestionImport($request->exam_id),$request->file('import'));
        $this->repository->addQuestionsWAnswerImport($request->exam_id,$data[0]);
        return redirect('admin/exam');
    }
}
