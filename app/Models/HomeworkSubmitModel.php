<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Request;

class HomeworkSubmitModel extends Model
{
    protected $table = 'homework_submit';

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

}
