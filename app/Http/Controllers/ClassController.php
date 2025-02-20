<?php

namespace App\Http\Controllers;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Auth;

class ClassController extends Controller
{
    public function list()
    {
        $data['getRecord'] = ClassModel::getRecord();
        $data['header_title'] = "Class List";
        return view('admin.class.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Add New Class";
        return view('admin.class.add', $data);
    }

    public function insert(Request $request)
    {
        $save = new ClassModel;
        $save->name = trim($request->name);
        $save->amount = trim($request->amount);
        $save->status = trim($request->status);
        $save->created_by = Auth::user()->id;
        $save->save();

        return redirect('admin/class/list')->with('success', "Class successfully created");
    }

    public function edit($id)
    {
        $data['getRecord'] = ClassModel::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Edit Class";
            return view('admin.class.edit', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        $save = ClassModel::getSingle($id);
        $save->name = trim($request->name);
        $save->amount = trim($request->amount);
        $save->status = trim($request->status);
        $save->save();

        return redirect('admin/class/list')->with('success', "Class successfully updated");
    }

    public function delete($id)
    {
        $save = ClassModel::getSingle($id);
        $save->is_delete = 1;
        $save->save();

        return redirect('admin/class/list')->with('success', "Class successfully deleted");
    }

}
