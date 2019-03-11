<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\ExamType;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\ExamQuestion\ExamQuestionRepository;
use App\Repositories\ExamType\ExamTypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamTypeController extends Controller
{
    protected $repository;

    public function __construct(ExamTypeRepository $repository)
    {
        $this->repository = $repository;
        app()->setLocale('ar');
    }

    public function index(){
        $exam_types = $this->repository->getAll();
        return view('backend.exam_types.index',compact('exam_types'));
    }

    public function edit($type_id){
        $type = ExamType::whereId($type_id)->first();
        return view('backend.exam_types.edit',compact('type'));
    }

    public function update($id,Request $request){
        $exam_type = ExamType::whereId($id)->first();
        $exam_type->name = $request->name;
        $exam_type->save();
        return redirect('admin/exam-type');
    }


}
