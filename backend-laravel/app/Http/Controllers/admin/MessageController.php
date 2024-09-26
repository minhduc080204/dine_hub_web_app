<?php

namespace App\Http\Controllers\admin;

use App\Events\CommonChannel;
use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with('user')
            ->orderBy('created_at', 'asc')
            ->get()
            ->reverse()
            ->groupBy('user_id');
        $title = 'Quản lý hội thoại';
        return view('admin.pages.message.index', compact('title', 'messages'));
    }
    public function sendMessage(Request $request)
    {
        $userId = $request->input('userId');
        $message = $request->input('content');
        $role = $request->input('role');
        event(new MessageSent($userId, $message, $role));
        Message::create([
            'user_id' => $request->input('userId'),
            'content' => $message,
            'role' => $role,
            'status' => 'sended',
        ]);
        return response()->json(['status' => 'Message Sent!']);
    }
    public function getMessage(Request $request)
    {
        $userId = $request->input('userId');
        $message = Message::where('user_id', $userId)->get();
        event(new CommonChannel($userId));
        return response()->json($message);
    }
}