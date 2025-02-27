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
        if(!empty($request->receiver_id))
        {
            $receiver_id = base64_decode($request->receiver_id);
            if($receiver_id == $sender_id)
            {
                return redirect()->back()->with('error', "Cant send message to yourself! Please try again!");
                exit();
            }
            ChatModel::updateCount($sender_id, $receiver_id);

            $data['getReceiver'] = User::getSingle($receiver_id);
            // dd($data['getReceiver']);
            $data['getChat'] = ChatModel::getChat($receiver_id, $sender_id);
            // dd($data['getChat']);
        }

        $data['getChatUser'] = ChatModel::getChatUser($sender_id);
        // dd($data['getChatUser']);

        return view('chat.list', $data);
    }

    public function submit_message(Request $request)
    {
        $chat = new ChatModel;
        $chat->sender_id = Auth::user()->id;
        $chat->receiver_id = $request->receiver_id;
        $chat->message = $request->message;
        $chat->created_date = time();
        $chat->save();

        $getChat = ChatModel::where('id', '=', $chat->id)->get();

        return response()->json([
            "status" => true,
            "success" => view('chat._single', [
                "getChat" => $getChat
            ])->render(),
        ],200);
    }

}
