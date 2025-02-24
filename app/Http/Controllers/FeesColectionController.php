<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\ClassModel;
use App\Models\SettingModel;
use Illuminate\Http\Request;
use App\Models\StudentAddFeesModel;
use Stripe\Stripe;
use Session;

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
                else if($request->payment_type == 'stripe')
                {
                    $setPublicKey = $getSetting->stripe_key;
                    $setApiKey = $getSetting->stripe_secret;

                    Stripe::setApiKey($setApiKey);
                    $finalprice = $request->amount * 100;

                    $session = \Stripe\Checkout\Session::create([
                        'customer_email' => Auth::user()->email,
                        'payment_method_types' => ['card'],
                        'line_items' => [[
                            'price_data' => [
                                'currency' => 'usd',
                                'product_data' => [
                                    'name' => 'Student Fees',
                                    'description' => 'Student Fees',
                                ],
                                'unit_amount' => intval($finalprice),
                            ],
                            'quantity' => 1,
                        ]],
                        'mode' => 'payment',
                        'success_url' => url('student/stripe/payment-success'),
                        'cancel_url' => url('student/stripe/payment-error'),
                    ]);

                    $payment->stripe_session_id = $session['id'];
                    $payment->save();

                    $data['session_id'] = $session['id'];
                    Session::put('stripe_session_id', $session['id']);
                    $data['setPublickey'] = $setPublicKey;

                    return view('payment.stripe_charge', $data);

                }
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
        //Paypal auto redirect not working....

        if(!empty($request->item_number) && !empty($request->st) && $request->st == 'Completed')
        {
            $fees = StudentAddFeesModel::getSingle($request->item_number);
            if(!empty($fees))
            {
                $fees->is_payment = 1;
                $fees->payment_data = json_encode($request->all());
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

    public function payment_success_stripe(Request $request)
    {
        $getSetting = SettingModel::getSingle();
        $setPublicKey = $getSetting->stripe_key;
        $setApiKey = $getSetting->stripe_secret;

        $trans_id = Session::get('stripe_session_id');
        $getFee = StudentAddFeesModel::where('stripe_session_id', '=', $trans_id)->first();

        \Stripe\Stripe::setApiKey($setApiKey);
        $getdata = \Stripe\Checkout\Session::retrieve($trans_id);

        if(!empty($getdata->id) && $getdata->id == $trans_id && !empty($getFee) && $getdata->status == 'complete' && $getdata->payment_status == 'paid')
        {
            $getFee->is_payment = 1;
            $getFee->payment_data = json_encode($getdata->id);
            $getFee->save();

            Session::forget('stripe_session_id');

            return redirect('student/fees_collection')->with('success', "Your payment is successfull!");
        }
        else
        {
            return redirect('student/fees_collection')->with('error', "Due to some error. Please try again!");
        }
    }

    //parent side
    public function my_student_fees_collection($student_id, Request $request)
    {
        $data['getFees'] = StudentAddFeesModel::getFees($student_id);

        $getStudent = User::getSingleClass($student_id);
        $data['getStudent'] = $getStudent;

        $data['header_title'] = "Fees Collection";
        $data['paid_amount'] = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id);
        return view('parent.fees_colection', $data);
    }

    public function parent_collect_fees_payment($student_id, Request $request)
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
                $payment->student_id = $getStudent->id;
                $payment->class_id = $getStudent->class_id;
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
                    $query['cancel_return'] = url('parent/paypal/payment-error/'.$student_id);
                    $query['return'] = url('parent/paypal/payment-success/'.$student_id);

                    $query_string = http_build_query($query);

                    header('Location: http://www.sandbox.paypal.com/cgi-bin/webscr?'. $query_string);
                    exit();
                }
                else if($request->payment_type == 'stripe')
                {
                    $setPublicKey = $getSetting->stripe_key;
                    $setApiKey = $getSetting->stripe_secret;

                    Stripe::setApiKey($setApiKey);
                    $finalprice = $request->amount * 100;

                    $session = \Stripe\Checkout\Session::create([
                        'customer_email' => Auth::user()->email,
                        'payment_method_types' => ['card'],
                        'line_items' => [[
                            'price_data' => [
                                'currency' => 'usd',
                                'product_data' => [
                                    'name' => 'Student Fees',
                                    'description' => 'Student Fees',
                                ],
                                'unit_amount' => intval($finalprice),
                            ],
                            'quantity' => 1,
                        ]],
                        'mode' => 'payment',
                        'success_url' => url('parent/stripe/payment-success/'.$student_id),
                        'cancel_url' => url('parent/stripe/payment-error/'.$student_id),
                    ]);

                    $payment->stripe_session_id = $session['id'];
                    $payment->save();

                    $data['session_id'] = $session['id'];
                    Session::put('stripe_session_id', $session['id']);
                    $data['setPublickey'] = $setPublicKey;

                    return view('payment.stripe_charge', $data);

                }
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

    public function parent_payment_error($student_id)
    {
        return redirect('parent/my_student/fees_collection/'.$student_id)->with('error', "Due to some error. Please try again!");
    }

    public function parent_payment_success($student_id, Request $request)
    {
        if(!empty($request->item_number) && !empty($request->st) && $request->st == 'Completed')
        {
            $fees = StudentAddFeesModel::getSingle($request->item_number);
            if(!empty($fees))
            {
                $fees->is_payment = 1;
                $fees->payment_data = json_encode($request->all());
                $fees->save();

                return redirect('parent/my_student/fees_collection/'.$student_id)->with('success', "Your payment is successfully");
            }
            else
            {
                return redirect('parent/my_student/fees_collection/'.$student_id)->with('error', "Due to some error. Please try again!");
            }
        }
        else
        {
            return redirect('parent/my_student/fees_collection/'.$student_id)->with('error', "Due to some error. Please try again!");
        }
    }

    public function parent_payment_success_stripe($student_id, Request $request)
    {
        $getSetting = SettingModel::getSingle();
        $setPublicKey = $getSetting->stripe_key;
        $setApiKey = $getSetting->stripe_secret;

        $trans_id = Session::get('stripe_session_id');
        $getFee = StudentAddFeesModel::where('stripe_session_id', '=', $trans_id)->first();

        \Stripe\Stripe::setApiKey($setApiKey);
        $getdata = \Stripe\Checkout\Session::retrieve($trans_id);

        if(!empty($getdata->id) && $getdata->id == $trans_id && !empty($getFee) && $getdata->status == 'complete' && $getdata->payment_status == 'paid')
        {
            $getFee->is_payment = 1;
            $getFee->payment_data = json_encode($getdata->id);
            $getFee->save();

            Session::forget('stripe_session_id');

            return redirect('parent/my_student/fees_collection/'.$student_id)->with('success', "Your payment is successfull!");
        }
        else
        {
            return redirect('parent/my_student/fees_collection/'.$student_id)->with('error', "Due to some error. Please try again!");
        }
    }

}
