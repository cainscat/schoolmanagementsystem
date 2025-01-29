<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;
use Str;

class ParentController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getParent();
        $data['header_title'] = "Parent List";
        return view('admin.parent.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Add New Parent";
        return view('admin.parent.add', $data);
    }

    public function insert(Request $request)
    {

        request()->validate([
            'email' => 'required|email|unique:users',
            'mobile_number' => 'max:15|min:9',
            'address' => 'max:255',
            'occupation' => 'max:255'
        ]);

        $parent = new User;
        $parent->name = trim($request->name);
        $parent->last_name = trim($request->last_name);
        $parent->gender = trim($request->gender);

        if(!empty($request->file('profile_pic')))
        {
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
        $parent->password = Hash::make($request->password);
        $parent->user_type = 4;
        $parent->save();

        return redirect('admin/parent/list')->with('success', "Parent successfully created");
    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Edit Parent";
            return view('admin.parent.edit', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
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
        $parent->status = trim($request->status);
        $parent->email = trim($request->email);
        if(!empty($request->password))
        {
            $parent->password = Hash::make($request->password);
        }
        $parent->save();

        return redirect('admin/parent/list')->with('success', "Parent successfully updated");
    }

    public function delete($id)
    {
        $getRecord = User::getSingle($id);
        if(!empty($getRecord))
        {
            $getRecord->is_delete = 1;
            $getRecord->save();

            return redirect()->back()->with('success', "Parent successfully deleted");
        }
        else
        {
            abort(404);
        }
    }
}
