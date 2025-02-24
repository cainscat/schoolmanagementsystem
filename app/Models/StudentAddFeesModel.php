<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Request;

class StudentAddFeesModel extends Model
{
    protected $table = 'student_add_fees';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getRecord()
    {
        $return = self::select('student_add_fees.*', 'class.name as class_name', 'users.name as created_by_name', 'student.name as first_name', 'student.last_name as last_name')
                ->join('class', 'class.id', '=', 'student_add_fees.class_id')
                ->join('users as student', 'student.id', '=', 'student_add_fees.student_id')
                ->join('users', 'users.id', '=', 'student_add_fees.created_by')
                ->where('student_add_fees.is_payment', '=', 1);
                if(!empty(Request::get('student_id')))
                {
                    $return = $return->where('student_add_fees.student_id', '=', Request::get('student_id'));
                }
                if(!empty(Request::get('student_name')))
                {
                    $student_name = Request::get('student_name');
                    $return = $return->where(function($query) use ($student_name){
                        $query->where('student.name', 'like', '%'.$student_name.'%')->orWhere('student.last_name','like','%'.$student_name.'%');
                    });
                }
                if(!empty(Request::get('class_id')))
                {
                    $return = $return->where('student_add_fees.class_id', '=', Request::get('class_id'));
                }
                if(!empty(Request::get('start_created_date')))
                {
                    $return = $return->whereDate('student_add_fees.created_at', '>=', Request::get('start_created_date'));
                }
                if(!empty(Request::get('end_created_date')))
                {
                    $return = $return->whereDate('student_add_fees.created_at', '<=', Request::get('end_created_date'));
                }
                if(!empty(Request::get('payment_type')))
                {
                    $return = $return->where('student_add_fees.payment_type', '=', Request::get('payment_type'));
                }
        $return = $return->orderBy('student_add_fees.id', 'desc')
                ->paginate(50);
        return $return;
    }

    static public function getFees($student_id)
    {
        return self::select('student_add_fees.*', 'class.name as class_name', 'users.name as created_by_name')
                ->join('class', 'class.id', '=', 'student_add_fees.class_id')
                ->join('users', 'users.id', '=', 'student_add_fees.created_by')
                ->where('student_add_fees.student_id', '=', $student_id)
                ->where('student_add_fees.is_payment', '=', 1)
                ->get();
    }

    static public function getPaidAmount($student_id, $class_id)
    {
        return self::where('student_add_fees.student_id', '=', $student_id)
                ->where('student_add_fees.class_id', '=', $class_id)
                ->where('student_add_fees.is_payment', '=', 1)
                ->sum('student_add_fees.paid_amount');
    }

    static public function getTotalTodayFees()
    {
        return self::where('student_add_fees.is_payment', '=', 1)
                ->whereDate('student_add_fees.created_at', '=', date('Y-m-d'))
                ->sum('student_add_fees.paid_amount');
    }

    static public function getTotalFees()
    {
        return self::where('student_add_fees.is_payment', '=', 1)
                ->sum('student_add_fees.paid_amount');
    }

}
