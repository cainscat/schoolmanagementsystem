<?php

namespace App\Http\Controllers;
use Auth;

use App\Models\WeekModel;
use Illuminate\Http\Request;
use App\Models\ClassSubjectModel;
use App\Models\ExamScheduleModel;
use App\Models\ClassSubjectTimetableModel;

class CalendarController extends Controller
{
    public function my_calendar()
    {
        //Timetable
        $data['getMyTimeTable'] = $this->get_timetable(Auth::user()->class_id);

        $data['getExamTimeTable'] = $this->get_exam_timetable(Auth::user()->class_id);
        // dd($data['getExamTimeTable']);

        $data['header_title'] = "My Calendar";
        return view('student.my_calendar', $data);
    }

    public function get_timetable($class_id)
    {
        $result = array();
        $getRecord = ClassSubjectModel::mySubject($class_id);
        foreach($getRecord as $value)
        {
            $dataS['name'] = $value->subject_name;

            $getWeek = WeekModel::getRecord();
            $week = array();
            foreach($getWeek as $valueW)
            {
                $dataW = array();
                $dataW['week_name'] = $valueW->name;
                $dataW['fullcalendar_day'] = $valueW->fullcalendar_day;

                $ClassSubject = ClassSubjectTimetableModel::getRecordClassSubject($value->class_id, $value->subject_id, $valueW->id);
                if(!empty($ClassSubject))
                {
                    $dataW['start_time'] = $ClassSubject->start_time;
                    $dataW['end_time'] = $ClassSubject->end_time;
                    $dataW['room_number'] = $ClassSubject->room_number;
                    $week[] = $dataW;
                }
            }

            $dataS['week'] = $week;
            $result[] = $dataS;
        }
        return $result;
    }

    public function get_exam_timetable($class_id)
    {
        $getExam = ExamScheduleModel::getExam($class_id);
        $result = array();
        foreach($getExam as $value)
        {
            $dataE = array();
            $dataE['name'] = $value->exam_name;
            $getExamTimetable = ExamScheduleModel::getExamTimetable($value->exam_id, $class_id);
            $resultS = array();
            foreach($getExamTimetable as $valueS)
            {
                $dataS = array();
                $dataS['subject_name'] = $valueS->subject_name;
                $dataS['exam_date'] = $valueS->exam_date;
                $dataS['start_time'] = $valueS->start_time;
                $dataS['end_time'] = $valueS->end_time;
                $dataS['room_number'] = $valueS->room_number;
                $dataS['full_marks'] = $valueS->full_marks;
                $dataS['passing_marks'] = $valueS->passing_marks;
                $resultS[] = $dataS;
            }
            $dataE['exam'] = $resultS;
            $result[] = $dataE;
        }

        return $result;
    }

}
