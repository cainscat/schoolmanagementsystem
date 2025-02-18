<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\SendEmailUserMail;
use App\Models\NoticeBoardModel;
use App\Models\NoticeBoardMessageModel;

class CommunicateController extends Controller
{
    public function send_email()
    {
        $data['header_title'] = "Send Email";
        return view('admin.communicate.send_email', $data);
    }

    public function search_user(Request $request)
    {
        $json = array();
        if(!empty($request->search))
        {
            $getUser = User::searchUser($request->search);
            foreach($getUser as $value)
            {
                $type = '';
                if($value->user_type == 1)
                {
                    $type = 'Admin';
                }
                elseif($value->user_type == 2)
                {
                    $type = 'Teacher';
                }
                elseif($value->user_type == 3)
                {
                    $type = 'Student';
                }
                elseif($value->user_type == 4)
                {
                    $type = 'Parent';
                }

                $name = $value->name.' '.$value->last_name.' - '.$type;
                $json[] = ['id'=>$value->id, 'text'=>$name];
            }
        }

        echo json_encode($json);
    }

    public function send_email_user(Request $request)
    {
        if(!empty($request->user_id))
        {
            $user = User::getSingle($request->user_id);
            $user->send_message = $request->message;
            $user->send_subject = $request->subject;

            Mail::to($user->email)->send(new SendEmailUserMail($user));
        }

        return redirect()->back()->with('success', "Mail successfully send!");

    }

    public function notice_board()
    {
        $data['getRecord'] = NoticeBoardModel::getRecord();
        $data['header_title'] = "Notice Board";
        return view('admin.communicate.notice_board.list', $data);
    }

    public function add_notice_board()
    {
        $data['header_title'] = "Add New Notice Board";
        return view('admin.communicate.notice_board.add', $data);
    }

    public function insert_notice_board(Request $request)
    {
        $save = new NoticeBoardModel;
        $save->title = trim($request->title);
        $save->notice_date = trim($request->notice_date);
        $save->publish_date = trim($request->publish_date);
        $save->message = trim($request->message);
        $save->created_by = Auth::user()->id;
        $save->save();

        if(!empty($request->message_to))
        {
            foreach($request->message_to as $message_to)
            {
                $message = new NoticeBoardMessageModel;
                $message->notice_board_id = $save->id;
                $message->message_to = $message_to;
                $message->save();
            }
        }

        return redirect('admin/communicate/notice_board')->with('success', "New Notice Board successfully created");
    }

    public function edit_notice_board($id)
    {
        $data['getRecord'] = NoticeBoardModel::getSingle($id);
        $data['header_title'] = "Edit Notice Board";
        return view('admin.communicate.notice_board.edit', $data);
    }

    public function update_notice_board($id, Request $request)
    {
        $save = NoticeBoardModel::getSingle($id);
        $save->title = trim($request->title);
        $save->notice_date = trim($request->notice_date);
        $save->publish_date = trim($request->publish_date);
        $save->message = trim($request->message);
        $save->save();

        NoticeBoardMessageModel::deleteRecord($id);
        if(!empty($request->message_to))
        {
            foreach($request->message_to as $message_to)
            {
                $message = new NoticeBoardMessageModel;
                $message->notice_board_id = $save->id;
                $message->message_to = $message_to;
                $message->save();
            }
        }

        return redirect('admin/communicate/notice_board')->with('success', "Notice Board successfully updated");
    }

    public function delete_notice_board($id)
    {
        $save = NoticeBoardModel::getSingle($id);
        $save->delete();
        NoticeBoardMessageModel::deleteRecord($id);
        return redirect()->back()->with('success', "Notice Board successfully deleted");
    }

    //student side
    public function student_notice_board()
    {
        $data['getRecord'] = NoticeBoardModel::getRecordUser(Auth::user()->user_type);
        $data['header_title'] = "Notice Board";
        return view('student.my_notice_board', $data);
    }

    //teacher side
    public function teacher_notice_board()
    {
        $data['getRecord'] = NoticeBoardModel::getRecordUser(Auth::user()->user_type);
        $data['header_title'] = "Notice Board";
        return view('teacher.my_notice_board', $data);
    }

    //parent side
    public function parent_notice_board()
    {
        $data['getRecord'] = NoticeBoardModel::getRecordUser(Auth::user()->user_type);
        $data['header_title'] = "Notice Board";
        return view('parent.my_notice_board', $data);
    }

    public function parent_student_notice_board()
    {
        $data['getRecord'] = NoticeBoardModel::getRecordUser(3);
        $data['header_title'] = "Student Notice Board";
        return view('parent.my_student_notice_board', $data);
    }

}
