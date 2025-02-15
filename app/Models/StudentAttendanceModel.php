<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAttendanceModel extends Model
{
    protected $table = 'student_attendance';

    static public function checkAlreadyAttendance($student_id, $class_id, $attendance_date)
    {
        return StudentAttendanceModel::where('student_id', '=', $student_id)
                    ->where('class_id', '=', $class_id)
                    ->where('attendance_date', '=', $attendance_date)
                    ->first();
    }

}
