<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;

class ChatController extends Controller
{
    public function index()
    {
        // Fetch all messages
        $messages = Message::with('user')->orderBy('created_at', 'asc')->get();
        return view('admin.groupChat', compact('messages'));
    }

    public function fetchMessages()
    {

        return response()->json(Message::orderBy('created_at', 'asc')->get());
    }

    // Send a message
    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'sender_name' => $request->input('sender_name'),
            'profile_img' => $request->input('profile_img'),
            'message' => $request->input('message'),
            'user_id' => auth()->id(),
        ]);

        return response()->json($message);
    }

    // public function createGroup(Request $request)
    // {
    //     $group = Group::create([
    //         'name' => $request->name,
    //         'created_by' => auth()->id(),
    //     ]);

    //     $group->users()->attach($request->user_ids); // Array of user IDs

    //     return response()->json(['message' => 'Group created successfully']);
    // }

    // public function sendMessage(Request $request)
    // {
    //     $message = Message::create([
    //         'group_id' => $request->group_id,
    //         'user_id' => auth()->id(),
    //         'message' => $request->message,
    //     ]);

    //     return response()->json(['message' => 'Message sent successfully']);
    // }

    // public function fetchMessages($groupId)
    // {
    //     $messages = Message::where('group_id', $groupId)
    //         ->with('user')
    //         ->get();

    //     return response()->json($messages);
    // }
}
