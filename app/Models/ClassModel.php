<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Request;

class ClassModel extends Model
{
    protected $table = 'class';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getRecord()
    {
        $return = self::select('class.*', 'users.name as created_by_name')
                    ->join('users', 'users.id', 'class.created_by')
                    ->where('class.is_delete', '=', 0);

        if(!empty(Request::get('name')))
        {
            $return = $return->where('class.name', 'like', '%'.Request::get('name').'%');
        }
        if(!empty(Request::get('date')))
        {
            $return = $return->whereDate('class.created_at', '=',Request::get('date'));
        }

        $return = $return->orderBy('class.id', 'desc')
                    ->paginate(20);

        return $return;
    }
}
