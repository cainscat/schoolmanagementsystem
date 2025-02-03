<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeekModel extends Model
{
    protected $table = 'week';

    static public function getRecord()
    {
        return WeekModel::get();
    }
}
