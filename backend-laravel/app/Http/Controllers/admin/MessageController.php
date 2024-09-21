<?php

namespace App\Http\Controllers\admin;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::all()->groupBy('user_id');
        $title = 'Hội thoại';
        return view('admin.pages.message.index', compact('title', 'messages'));

    }
    public function sendMessage(Request $request)
    {
        $message = $request->input('message');
        // Message::create([
        //     'message' => $message,
        //     'user_id' => $request->input('userId'),    
        // ]);
        event(new MessageSent($message));
        return response()->json(['status' => 'Message Sent!']);
    }
    public function getMessage(Request $request)
    {
        $message = Message::where('user_id', $request->input('userId'))->get();
        return response()->json($message);
    }
}