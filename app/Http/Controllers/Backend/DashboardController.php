<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\ExamType;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\ExamQuestion\ExamQuestionRepository;
use App\Repositories\ExamType\ExamTypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        app()->setLocale('ar');
    }

    public function index(){
        return view('backend.dashboard.index');
    }

}
