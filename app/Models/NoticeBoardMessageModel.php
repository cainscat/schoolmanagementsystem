<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoticeBoardMessageModel extends Model
{
    protected $table = 'notice_board_message';

    static public function deleteRecord($id)
    {
        NoticeBoardMessageModel::where('notice_board_id', '=', $id)->delete();
    }

}
