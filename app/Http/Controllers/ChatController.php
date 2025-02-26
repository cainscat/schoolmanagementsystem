<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ChatController extends Controller
{
    public function chat()
    {
        $data['header_title'] = "Chat";
        return view('chat.list', $data);
    }

}
