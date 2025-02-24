<?php

namespace App\Http\Controllers;
use Auth;

use App\Models\User;
use App\Models\ExamModel;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use Illuminate\Http\Request;
use App\Models\StudentAddFeesModel;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['header_title'] = 'Dashboard';
        if(Auth::user()->user_type == 1)
        {
            $data['getTotalTodayFees'] = StudentAddFeesModel::getTotalTodayFees();
            $data['getTotalFees'] = StudentAddFeesModel::getTotalFees();
            $data['TotalAdmin'] = User::getTotalUser(1);
            $data['TotalTeacher'] = User::getTotalUser(2);
            $data['TotalStudent'] = User::getTotalUser(3);
            $data['TotalParent'] = User::getTotalUser(4);
            $data['TotalExam'] = ExamModel::getTotalExam();
            $data['TotalClass'] = ClassModel::getTotalClass();
            $data['TotalSubject'] = SubjectModel::getTotalSubject();

            return view('admin.dashboard', $data);
        }
        elseif(Auth::user()->user_type == 2)
        {
            return view('teacher.dashboard', $data);
        }
        elseif(Auth::user()->user_type == 3)
        {
            return view('student.dashboard', $data);
        }
        elseif(Auth::user()->user_type == 4)
        {
            return view('parent.dashboard', $data);
        }
    }
}
