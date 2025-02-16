<?php

namespace App\Http\Controllers;
use Auth;

use App\Models\User;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use App\Models\StudentAttendanceModel;
use App\Models\AssignClassTeacherModel;

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

    //teacher side
    public function teacher_attendance_student(Request $request)
    {
        $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        if(!empty($request->get('class_id')) && !empty($request->get('attendance_date')))
        {
            $data['getStudent'] = User::getStudentClass($request->get('class_id'));
        }
        $data['header_title'] = "Student Attendance";
        return view('teacher.attendance.student', $data);
    }

    public function teacher_attendance_report(Request $request)
    {
        $getClass = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        $classarray = array();
        foreach($getClass as $value)
        {
            $classarray[] = $value->class_id;
        }

        $data['getClass'] = $getClass;
        $data['getRecord'] = StudentAttendanceModel::getRecordTeacher($classarray);
        $data['header_title'] = "Attendance Report";
        return view('teacher.attendance.report', $data);
    }

    //student side
    public function my_attendance_student(Request $request)
    {
        $data['getClass'] = StudentAttendanceModel::getClassStudent(Auth::user()->id);
        $data['getRecord'] = StudentAttendanceModel::getRecordStudent(Auth::user()->id);
        $data['header_title'] = "My Attendance";
        return view('student.my_attendance', $data);
    }

    //parent side
    public function my_student_attendance($student_id)
    {
        $data['getStudent'] = User::getSingle($student_id);
        $data['getClass'] = StudentAttendanceModel::getClassStudent($student_id);
        $data['getRecord'] = StudentAttendanceModel::getRecordStudent($student_id);
        $data['header_title'] = "Student Attendance";
        return view('parent.my_student_attendance', $data);
    }

}
