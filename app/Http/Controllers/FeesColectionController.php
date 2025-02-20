<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\User;
use Auth;

class FeesColectionController extends Controller
{
    public function collect_fees(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();

        if(!empty($request->all()))
        {
            $data['getRecord'] = User::getCollectFeesStudent();
        }
        $data['header_title'] = "Collect Fees";
        return view('admin.fees_colection.collect_fees', $data);
    }

    public function add_collect_fees($student_id)
    {
        $data['header_title'] = "Add Collect Fees";
        return view('admin.fees_colection.add_collect_fees', $data);
    }

}
