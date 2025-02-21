<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\User;
use App\Models\StudentAddFeesModel;
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
        $data['getFees'] = StudentAddFeesModel::getFees($student_id);
        $getStudent = User::getSingleClass($student_id);
        $data['getStudent'] = $getStudent;
        $data['header_title'] = "Add Collect Fees";
        $data['paid_amount'] = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id);
        return view('admin.fees_colection.add_collect_fees', $data);
    }

    public function insert_collect_fees($student_id, Request $request)
    {
        $getStudent = User::getSingleClass($student_id);
        $paid_amount = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id);
        if(!empty($request->amount))
        {
            $remaningAmount = $getStudent->amount - $paid_amount;
            if($remaningAmount >= $request->amount)
            {
                $remaning_amount_user = $remaningAmount - $request->amount;

                $payment = new StudentAddFeesModel;
                $payment->student_id = $student_id;
                $payment->class_id = $getStudent->class_id;
                $payment->paid_amount = trim($request->amount);
                $payment->total_amount = trim($remaningAmount);
                $payment->remaning_amount = $remaning_amount_user;
                $payment->payment_type = trim($request->payment_type);
                $payment->remark = trim($request->remark);
                $payment->created_by = Auth::user()->id;
                $payment->save();

                return redirect()->back()->with('success', "Fees successfully add");
            }
            else
            {
                return redirect()->back()->with('error', "Your amount go to greather than remaning amount");
            }
        }
        else
        {
            return redirect()->back()->with('error', "You need to add at least 1$");
        }

    }

}
