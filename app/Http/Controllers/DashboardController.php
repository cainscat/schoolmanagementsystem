<?php

namespace App\Http\Controllers;
use Auth;

use App\Models\User;
use App\Models\ExamModel;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use Illuminate\Http\Request;
use App\Models\HomeworkModel;
use App\Models\NoticeBoardModel;
use App\Models\ClassSubjectModel;
use App\Models\HomeworkSubmitModel;
use App\Models\StudentAddFeesModel;
use App\Models\StudentAttendanceModel;
use App\Models\AssignClassTeacherModel;

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
            $data['TotalStudent'] = User::getTeacherStudentCount(Auth::user()->id);
            $data['TotalClass'] = AssignClassTeacherModel::getMyClassSubjectGroupCount(Auth::user()->id);
            $data['TotalSubject'] = AssignClassTeacherModel::getMyClassSubjectCount(Auth::user()->id);
            $data['TotalNotice'] = NoticeBoardModel::getTotalNotice(Auth::user()->user_type);

            return view('teacher.dashboard', $data);
        }
        elseif(Auth::user()->user_type == 3)
        {
            $data['TotalPaidAmount'] = StudentAddFeesModel::getTotalPaidAmountStudent(Auth::user()->id);
            $data['TotalSubject'] = ClassSubjectModel::getTotalSubject(Auth::user()->class_id);
            $data['TotalNotice'] = NoticeBoardModel::getTotalNotice(Auth::user()->user_type);
            $data['TotalHomework'] = HomeworkModel::getTotalHomeworkStudent(Auth::user()->class_id, Auth::user()->id);
            $data['TotalSubmittedHomework'] = HomeworkSubmitModel::getTotalSubmittedHomeworkStudent(Auth::user()->id);
            $data['TotalAttendance'] = StudentAttendanceModel::getTotalAttendanceStudent(Auth::user()->id);

            return view('student.dashboard', $data);
        }
        elseif(Auth::user()->user_type == 4)
        {
            $student_ids = User::getMyStudentIDs(Auth::user()->id);
            $class_ids = User::getMyStudentClassIDs(Auth::user()->id);

            if(!empty($student_ids))
            {
                $data['TotalPaidAmount'] = StudentAddFeesModel::getTotalPaidAmountStudentParent($student_ids);
                $data['TotalAttendance'] = StudentAttendanceModel::getTotalAttendanceStudentParent($student_ids);
                $data['TotalSubmittedHomework'] = HomeworkSubmitModel::getTotalSubmittedHomeworkStudentParent($student_ids);

            }
            else
            {
                $data['TotalPaidAmount'] = 0;
                $data['TotalAttendance'] = 0;
                $data['TotalSubmittedHomework'] = 0;
            }

            $data['getTotalFees'] = StudentAddFeesModel::getTotalFees();
            $data['TotalStudent'] = User::getMyTotalStudentParent(Auth::user()->id);
            $data['TotalNotice'] = NoticeBoardModel::getTotalNotice(Auth::user()->user_type);


            return view('parent.dashboard', $data);
        }
    }
}
