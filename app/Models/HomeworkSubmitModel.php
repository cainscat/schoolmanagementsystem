<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Request;

class HomeworkSubmitModel extends Model
{
    protected $table = 'homework_submit';

    static public function getRecord($homework_id)
    {
        $return = HomeworkSubmitModel::select('homework_submit.*', 'users.name as first_name', 'users.last_name as last_name')
                ->join('users', 'users.id', '=', 'homework_submit.student_id')
                ->where('homework_submit.homework_id', '=', $homework_id);
                if(!empty(Request::get('student_name')))
                {
                    $student_name = Request::get('student_name');
                    $return = $return->where(function($query) use ($student_name){
                        $query->where('users.name', 'like', '%'.$student_name.'%')->orWhere('users.last_name','like','%'.$student_name.'%');
                    });
                }
                if(!empty(Request::get('created_date_from')))
                {
                    $return = $return->whereDate('homework_submit.created_at', '>=', Request::get('created_date_from'));
                }
                if(!empty(Request::get('created_date_to')))
                {
                    $return = $return->whereDate('homework_submit.created_at', '<=', Request::get('created_date_to'));
                }

        $return = $return->orderBy('homework_submit.id', 'desc')
                    ->paginate(50);
        return $return;
    }

    static public function getHomeworkReport()
    {
        $return = HomeworkSubmitModel::select('homework_submit.*', 'class.name as class_name', 'subject.name as subject_name', 'users.name as first_name', 'users.last_name as last_name')
                    ->join('users', 'users.id', '=', 'homework_submit.student_id')
                    ->join('homework', 'homework.id', '=', 'homework_submit.homework_id')
                    ->join('class', 'class.id', '=', 'homework.class_id')
                    ->join('subject', 'subject.id', '=', 'homework.subject_id');
                    if(!empty(Request::get('student_name')))
                    {
                        $student_name = Request::get('student_name');
                        $return = $return->where(function($query) use ($student_name){
                            $query->where('users.name', 'like', '%'.$student_name.'%')->orWhere('users.last_name','like','%'.$student_name.'%');
                        });
                    }
                    if(!empty(Request::get('class_name')))
                    {
                        $return = $return->where('class.name', 'like', '%'.Request::get('class_name').'%');
                    }
                    if(!empty(Request::get('subject_name')))
                    {
                        $return = $return->where('subject.name', 'like', '%'.Request::get('subject_name').'%');
                    }
                    if(!empty(Request::get('homework_date_from')))
                    {
                        $return = $return->where('homework.homework_date', '>=', Request::get('homework_date_from'));
                    }
                    if(!empty(Request::get('homework_date_to')))
                    {
                        $return = $return->where('homework.homework_date', '<=', Request::get('homework_date_to'));
                    }
                    if(!empty(Request::get('submission_date_from')))
                    {
                        $return = $return->where('homework.submission_date', '>=', Request::get('submission_date_from'));
                    }
                    if(!empty(Request::get('submission_date_to')))
                    {
                        $return = $return->where('homework.submission_date', '<=', Request::get('submission_date_to'));
                    }
                    if(!empty(Request::get('submited_date_from')))
                    {
                        $return = $return->whereDate('homework_submit.created_at', '>=', Request::get('submited_date_from'));
                    }
                    if(!empty(Request::get('submited_date_to')))
                    {
                        $return = $return->whereDate('homework_submit.created_at', '<=', Request::get('submited_date_to'));
                    }
        $return = $return->orderBy('homework_submit.id', 'desc')
                    ->paginate(20);

        return $return;
    }

    static public function getRecordStudent($student_id)
    {
        $return = HomeworkSubmitModel::select('homework_submit.*', 'class.name as class_name', 'subject.name as subject_name')
                    ->join('homework', 'homework.id', '=', 'homework_submit.homework_id')
                    ->join('class', 'class.id', '=', 'homework.class_id')
                    ->join('subject', 'subject.id', '=', 'homework.subject_id')
                    ->where('homework_submit.student_id', '=', $student_id);
                    if(!empty(Request::get('class_name')))
                    {
                        $return = $return->where('class.name', 'like', '%'.Request::get('class_name').'%');
                    }
                    if(!empty(Request::get('subject_name')))
                    {
                        $return = $return->where('subject.name', 'like', '%'.Request::get('subject_name').'%');
                    }
                    if(!empty(Request::get('homework_date_from')))
                    {
                        $return = $return->where('homework.homework_date', '>=', Request::get('homework_date_from'));
                    }
                    if(!empty(Request::get('homework_date_to')))
                    {
                        $return = $return->where('homework.homework_date', '<=', Request::get('homework_date_to'));
                    }
                    if(!empty(Request::get('submission_date_from')))
                    {
                        $return = $return->where('homework.submission_date', '>=', Request::get('submission_date_from'));
                    }
                    if(!empty(Request::get('submission_date_to')))
                    {
                        $return = $return->where('homework.submission_date', '<=', Request::get('submission_date_to'));
                    }
                    if(!empty(Request::get('submited_date_from')))
                    {
                        $return = $return->whereDate('homework_submit.created_at', '>=', Request::get('submited_date_from'));
                    }
                    if(!empty(Request::get('submited_date_to')))
                    {
                        $return = $return->whereDate('homework_submit.created_at', '<=', Request::get('submited_date_to'));
                    }
        $return = $return->orderBy('homework_submit.id', 'desc')
                    ->paginate(20);

        return $return;
    }

    static public function getTotalSubmittedHomeworkStudent($student_id)
    {
        $return = HomeworkSubmitModel::select('homework_submit.id')
                    ->join('homework', 'homework.id', '=', 'homework_submit.homework_id')
                    ->join('class', 'class.id', '=', 'homework.class_id')
                    ->join('subject', 'subject.id', '=', 'homework.subject_id')
                    ->where('homework_submit.student_id', '=', $student_id)
                    ->count();
        return $return;
    }

    public function getDocument()
    {
        if(!empty($this->document_file) && file_exists('upload/homework/'.$this->document_file))
        {
            return url('upload/homework/'.$this->document_file);
        }
        else
        {
            return "";
        }
    }

    public function getHomework()
    {
        return $this->belongsTo(HomeworkModel::class, 'homework_id');
    }

    public function getStudent()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

}
