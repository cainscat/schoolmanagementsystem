<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Request;

class HomeworkModel extends Model
{
    protected $table = 'homework';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getRecord()
    {
        $return = self::select('homework.*', 'users.name as created_by_name', 'class.name as class_name', 'subject.name as subject_name')
                ->join('users', 'users.id', '=', 'homework.created_by')
                ->join('class', 'class.id', '=', 'homework.class_id')
                ->join('subject', 'subject.id', '=', 'homework.subject_id')
                ->where('homework.is_delete', '=', 0);
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
                if(!empty(Request::get('created_date_from')))
                {
                    $return = $return->whereDate('homework.created_at', '>=', Request::get('homework_date_from'));
                }
                if(!empty(Request::get('created_date_to')))
                {
                    $return = $return->whereDate('homework.created_at', '<=', Request::get('created_date_to'));
                }
        $return = $return->orderBy('homework.id', 'desc')
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

}
