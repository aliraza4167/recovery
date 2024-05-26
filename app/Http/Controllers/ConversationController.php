<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Auth::user()->conversations[0]->messages);
        $conversations = Auth::user()->conversations;
        return Inertia::render('Conversation/Index', [
            'conversations' => $conversations,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // dd($request->id);
        $receiver_user = User::findOrFail($request->id);
        return Inertia::render('Conversation/Create', [
            'receiverUser' => $receiver_user,
            'messages' => $receiver_user->conversations[0]->messages
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        // VALIDATION
        $validated = $request->validate([
            'sender_id' => 'exists:users,id',
            'conversation_id' => 'exists:conversations,id',
            'message_body' => 'required'
        ]);

        Message::create([
            'conversation_id' => $validated['conversation_id'],
            'user_id' => Auth::user()->id,
            'content' => $validated['message_body'],
        ]);

        return redirect('conversations/' . $validated['conversation_id'])->with('message', 'Message sent successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Conversation $conversation)
    {
        $messages = $conversation->messages;
        // dd($messages);
        return Inertia::render('Conversation/Show', [
            'messages' => $messages,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(conversation $conversation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, conversation $conversation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(conversation $conversation)
    {
        //
    }
}
