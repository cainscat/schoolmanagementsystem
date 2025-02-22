<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingModel extends Model
{
    protected $table = 'setting';

    static public function getSingle()
    {
        return self::find(1);
    }

}
