<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\ChatModel;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $data['header_title'] = "Chat";

        $sender_id = Auth::user()->id;
        if(!empty($request->received_id))
        {
            $received_id = base64_decode($request->received_id);
            if($received_id == $sender_id)
            {
                return redirect()->back()->with('error', "Cant send message to yourself! Please try again!");
                exit();
            }

            $data['getReceived'] = User::getSingle($received_id);
        }

        return view('chat.list', $data);
    }

    public function submit_message(Request $request)
    {
        $chat = new ChatModel;
        $chat->sender_id = Auth::user()->id;
        $chat->received_id = $request->received_id;
        $chat->message = $request->message;
        $chat->created_date = time();
        $chat->save();

        $json['success'] = true;
        echo json_encode($json);
    }

}
