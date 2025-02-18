<?php

namespace App\Http\Controllers;

use Str;
use Auth;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use App\Models\HomeworkModel;
use App\Models\ClassSubjectModel;
use App\Models\AssignClassTeacherModel;

class HomeworkController extends Controller
{
    public function homework()
    {
        $data['getRecord'] = HomeworkModel::getRecord();
        $data['header_title'] = "Homework";
        return view('admin.homework.list', $data);
    }

    public function add_homework()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['header_title'] = "Add New Homework";
        return view('admin.homework.add', $data);
    }

    public function insert_homework(Request $request)
    {
        $homework = new HomeworkModel;
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);
        $homework->created_by = Auth::user()->id;

        if(!empty($request->file('document_file')))
        {
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('YmdHis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/homework/', $filename);

            $homework->document_file = $filename;
        }

        $homework->save();

        return redirect('admin/homework/homework')->with('success', "New Homewok successfully created");
    }

    public function edit_homework($id)
    {
        $getRecord = HomeworkModel::getSingle($id);
        $data['getRecord'] = $getRecord;
        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = ClassSubjectModel::mySubject($getRecord->class_id);
        $data['header_title'] = "Edit Homework";
        return view('admin.homework.edit', $data);
    }

    public function update_homework($id, Request $request)
    {
        $homework = HomeworkModel::getSingle($id);
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);

        if(!empty($request->file('document_file')))
        {
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('YmdHis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/homework/', $filename);

            $homework->document_file = $filename;
        }

        $homework->save();

        return redirect('admin/homework/homework')->with('success', "New Homewok successfully updated");
    }

    public function delete_homework($id)
    {
        $homework = HomeworkModel::getSingle($id);
        $homework->is_delete = 1;
        $homework->save();

        return redirect()->back()->with('success', "New Homewok successfully deleted");
    }

    public function ajax_get_subject(Request $request)
    {
        $class_id = $request->class_id;
        $getSubject = ClassSubjectModel::mySubject($class_id);
        $html = '';
        $html .= '<option value="">Select Subject</option>';
        foreach($getSubject as $value)
        {
            $html .= '<option value="'.$value->subject_id.'">'.$value->subject_name.'</option>';
        }

        $json['success'] = $html;
        echo json_encode($json);
    }

    //teacher side
    public function teacher_homework()
    {
        $class_ids = array();
        $getClass = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        foreach($getClass as $class)
        {
            $class_ids[] = $class->class_id;
        }

        $data['getRecord'] = HomeworkModel::getRecordTeacher($class_ids);
        $data['header_title'] = "Homework";
        return view('teacher.homework.list', $data);
    }

    public function teacher_add_homework()
    {
        $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        $data['header_title'] = "Add New Homework";
        return view('teacher.homework.add', $data);
    }

    public function teacher_insert_homework(Request $request)
    {
        $homework = new HomeworkModel;
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);
        $homework->created_by = Auth::user()->id;

        if(!empty($request->file('document_file')))
        {
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('YmdHis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/homework/', $filename);

            $homework->document_file = $filename;
        }

        $homework->save();

        return redirect('teacher/homework/homework')->with('success', "New Homewok successfully created");
    }

    public function teacher_edit_homework($id)
    {
        $getRecord = HomeworkModel::getSingle($id);
        $data['getRecord'] = $getRecord;
        $data['getSubject'] = ClassSubjectModel::mySubject($getRecord->class_id);
        $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        $data['header_title'] = "Edit Homework";
        return view('teacher.homework.edit', $data);
    }

    public function teacher_update_homework($id, Request $request)
    {
        $homework = HomeworkModel::getSingle($id);
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);

        if(!empty($request->file('document_file')))
        {
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('YmdHis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/homework/', $filename);

            $homework->document_file = $filename;
        }

        $homework->save();

        return redirect('teacher/homework/homework')->with('success', "New Homewok successfully updated");
    }


}
