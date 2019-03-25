<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\Exam;
use App\Models\ExamCode;
use App\Models\ExamType;
use App\Models\Suggestion;
use App\Models\User;
use App\Models\UserProgress;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\ExamQuestion\ExamQuestionRepository;
use App\Repositories\ExamType\ExamTypeRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        app()->setLocale('ar');
    }

    public function index(){
        $registeredUsersCount = User::where('user_status',1)->count();
        $examsCount = Exam::count();
        $examsCodeCount = ExamCode::count();
        $answeredExamsCount = UserProgress::whereHas('user')->whereHas('exam')->count();
        $suggestions = Suggestion::limit(10)->get();
        return view('backend.dashboard.index',compact('registeredUsersCount','examsCount','examsCodeCount','answeredExamsCount','suggestions'));
    }

    public function getUsersLineChart()
    {
        for ($i = 1; $i < 7; $i++) {
            $day[] = Carbon::now()->subDays($i)->format('Y-m-d');
        }
        foreach ($day as $value){
            $date = $value;
            $users = User::whereDate('created_at',$value)->count();
            $data[] = [
                'date' => $date,
                'users' => $users
            ];
        }
        return response()->json($data,200);
    }

}
