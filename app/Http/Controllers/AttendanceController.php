<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Auth;
use App\Models\User;
use App\Models\ClassModel;
use App\Models\StudentAttendanceModel;

class AttendanceController extends Controller
{
    public function attendance_student(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        if(!empty($request->get('class_id')) && !empty($request->get('attendance_date')))
        {
            $data['getStudent'] = User::getStudentClass($request->get('class_id'));
        }
        $data['header_title'] = "Student Attendance";
        return view('admin.attendance.student', $data);
    }

    public function attendance_student_submit(Request $request)
    {
        $checkAttendance = StudentAttendanceModel::checkAlreadyAttendance($request->student_id, $request->class_id, $request->attendance_date);
        if(!empty($checkAttendance))
        {
            $attendance = $checkAttendance;
        }
        else
        {
            $attendance = new StudentAttendanceModel;
            $attendance->student_id = trim($request->student_id);
            $attendance->class_id = trim($request->class_id);
            $attendance->attendance_date = trim($request->attendance_date);
            $attendance->created_by = Auth::user()->id;
        }

        $attendance->attendance_type = trim($request->attendance_type);
        $attendance->save();

        $json['message'] = "Attendance Successfully Saved";
        echo json_encode($json);
    }

    public function attendance_report(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getRecord'] = StudentAttendanceModel::getRecord();
        $data['header_title'] = "Attendance Report";
        return view('admin.attendance.report', $data);
    }


}
