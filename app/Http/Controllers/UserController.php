<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SettingModel;
use Auth;
use Hash;

class UserController extends Controller
{
    public function setting()
    {
        $data['getRecord'] = SettingModel::getSingle();
        $data['header_title'] = "System Setting";
        return view('admin.setting', $data);
    }

    public function update_setting(Request $request)
    {
        $setting = SettingModel::getSingle();
        $setting->paypal_email = trim($request->paypal_email);
        $setting->save();

        return redirect()->back()->with('success', "Setting is successfully updated");
    }

    public function change_password()
    {
        $data['header_title'] = "Change Password";
        return view('profile.change_password', $data);
    }

    public function update_change_password(Request $request)
    {
        $user = User::getSingle(Auth::user()->id);
        if(Hash::check($request->old_password , $user->password))
        {
            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->back()->with('success', "Password is successfully updated");
        }
        else
        {
            return redirect()->back()->with('error', "Old password is not correct");
        }
    }

    public function my_account()
    {
        $data['getRecord'] = User::getSingle(Auth::user()->id);
        $data['header_title'] = "My Account";
        if(Auth::user()->user_type == 1)
        {
            return view('admin.my_account', $data);
        }
        else if(Auth::user()->user_type == 2)
        {
            return view('teacher.my_account', $data);
        }
        else if(Auth::user()->user_type == 3)
        {
            return view('student.my_account', $data);
        }
        else if(Auth::user()->user_type == 4)
        {
            return view('parent.my_account', $data);
        }

    }

    public function update_my_account(Request $request)
    {
        $id = Auth::user()->id;
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        $user = User::getSingle($id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->save();

        return redirect()->back()->with('success', "Account successfully updated");
    }

    public function update_my_account_teacher(Request $request)
    {
        $id = Auth::user()->id;
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            'marital_status' => 'max:50'
        ]);

        $teacher = User::getSingle($id);
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->gender = trim($request->gender);

        if(!empty($request->file('profile_pic')))
        {
            if(!empty($teacher->getProfile()))
            {
                unlink('upload/profile/'.$teacher->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('YmdHis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $filename);

            $teacher->profile_pic = $filename;
        }
        if(!empty($request->date_of_birth))
        {
            $teacher->date_of_birth = trim($request->date_of_birth);
        }
        $teacher->permanent_address = trim($request->permanent_address);
        $teacher->qualification = trim($request->qualification);
        $teacher->work_experience = trim($request->work_experience);
        $teacher->marital_status = trim($request->marital_status);
        $teacher->address = trim($request->address);
        $teacher->mobile_number = trim($request->mobile_number);
        $teacher->email = trim($request->email);
        // if(!empty($request->password))
        // {
        //     $teacher->password = Hash::make($request->password);
        // }
        $teacher->save();

        return redirect()->back()->with('success', "Account successfully updated");
    }

    public function update_my_account_student(Request $request)
    {
        $id = Auth::user()->id;
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            'marital_status' => 'max:50',
            'height' => 'max:10',
            'weight' => 'max:10',
            'blood_group' => 'max:10',
            'mobile_number' => 'max:15|min:9',
            'caste' => 'max:50',
            'religion' => 'max:50'
        ]);

        $student = User::getSingle($id);
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->gender = trim($request->gender);

        if(!empty($request->file('profile_pic')))
        {
            if(!empty($student->getProfile()))
            {
                unlink('upload/profile/'.$student->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('YmdHis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $filename);

            $student->profile_pic = $filename;
        }
        if(!empty($request->date_of_birth))
        {
            $student->date_of_birth = trim($request->date_of_birth);
        }
        $student->blood_group = trim($request->blood_group);
        $student->height = trim($request->height);
        $student->weight = trim($request->weight);
        $student->caste = trim($request->caste);
        $student->religion = trim($request->religion);
        $student->mobile_number = trim($request->mobile_number);
        $student->email = trim($request->email);
        // if(!empty($request->password))
        // {
        //     $student->password = Hash::make($request->password);
        // }
        $student->save();

        return redirect()->back()->with('success', "Account successfully updated");
    }

    public function update_my_account_parent(Request $request)
    {
        $id = Auth::user()->id;
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            'mobile_number' => 'max:15|min:9',
            'address' => 'max:255',
            'occupation' => 'max:255'
        ]);

        $parent = User::getSingle($id);
        $parent->name = trim($request->name);
        $parent->last_name = trim($request->last_name);
        $parent->gender = trim($request->gender);

        if(!empty($request->file('profile_pic')))
        {
            if(!empty($parent->getProfile()))
            {
                unlink('upload/profile/'.$parent->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('YmdHis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $filename);
            $parent->profile_pic = $filename;
        }

        $parent->occupation = trim($request->occupation);
        $parent->address = trim($request->address);
        $parent->mobile_number = trim($request->mobile_number);
        $parent->email = trim($request->email);
        // if(!empty($request->password))
        // {
        //     $parent->password = Hash::make($request->password);
        // }
        $parent->save();

        return redirect()->back()->with('success', "Parent successfully updated");
    }

}
