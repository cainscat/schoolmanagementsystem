<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\ClassModel;
use App\Models\SettingModel;
use Illuminate\Http\Request;
use App\Models\StudentAddFeesModel;

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
                $payment->is_payment = 1;
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


    //student side
    public function student_collect_fees(Request $request)
    {
        $student_id = Auth::user()->id;
        $data['getFees'] = StudentAddFeesModel::getFees($student_id);
        $getStudent = User::getSingleClass($student_id);
        $data['getStudent'] = $getStudent;
        $data['header_title'] = "Fees Collection";
        $data['paid_amount'] = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id);
        return view('student.my_fees_colection', $data);
    }

    public function student_collect_fees_payment(Request $request)
    {
        $getStudent = User::getSingleClass(Auth::user()->id);
        $paid_amount = StudentAddFeesModel::getPaidAmount(Auth::user()->id, Auth::user()->class_id);

        if(!empty($request->amount))
        {
            $remaningAmount = $getStudent->amount - $paid_amount;
            if($remaningAmount >= $request->amount)
            {
                $remaning_amount_user = $remaningAmount - $request->amount;

                $payment = new StudentAddFeesModel;
                $payment->student_id = Auth::user()->id;
                $payment->class_id = Auth::user()->class_id;
                $payment->paid_amount = trim($request->amount);
                $payment->total_amount = trim($remaningAmount);
                $payment->remaning_amount = $remaning_amount_user;
                $payment->payment_type = trim($request->payment_type);
                $payment->remark = trim($request->remark);
                $payment->created_by = Auth::user()->id;
                $payment->save();

                $getSetting = SettingModel::getSingle();
                if($request->payment_type == 'paypal')
                {
                    $query = array();
                    $query['business'] = $getSetting->paypal_email;
                    $query['cmd'] = '_xclick';
                    $query['item_name'] = "Student Fees";
                    $query['no_shipping'] = '1';
                    $query['item_number'] = $payment->id;
                    $query['amount'] = $request->amount;
                    $query['currency_code'] = 'USD';
                    $query['cancel_return'] = url('student/paypal/payment-error');
                    $query['return'] = url('student/paypal/payment-success');

                    $query_string = http_build_query($query);

                    header('Location: http://www.sandbox.paypal.com/cgi-bin/webscr?'. $query_string);
                    exit();
                }
                elseif($request->payment_type == 'stripe')
                {

                }
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

    public function payment_error()
    {
        return redirect('student/fees_collection')->with('error', "Due to some error. Please try again!");
    }

    public function payment_success(Request $request)
    {
        // if(!empty($request->PayerID))
        // {
        //     echo 'Paypal auto redirect not work!';
        //     dd($request->all());
        // }

        //Paypal auto redirect not working....

        if(!empty($request->item_number) && !empty($request->st) && $request->st == 'Completed')
        {
            $fees = StudentAddFeesModel::getSingle($request->item_number);
            if(!empty($fees))
            {
                $fees->is_payment = 1;
                $fees->payment_data = json_encode($request->all);
                $fees->save();

                return redirect('student/fees_collection')->with('success', "Your payment is successfully");
            }
            else
            {
                return redirect('student/fees_collection')->with('error', "Due to some error. Please try again!");
            }
        }
        else
        {
            return redirect('student/fees_collection')->with('error', "Due to some error. Please try again!");
        }
    }


}
