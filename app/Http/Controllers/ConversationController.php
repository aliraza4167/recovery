<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessageResource;
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
        foreach ($conversations as $conversation) {
            $message_count[] = $conversation->messages->where('user_id', '!=', Auth::user()->id)->where('is_read', false);
        }
        // dd($message_count);

        return Inertia::render('Conversation/Index', [
            'conversations' => $conversations,
            'message_count' => $message_count,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request);
        $recipient = User::findOrFail($request->id);

        // create conversation record
        $new_conversation = Conversation::create([
            'name' => $recipient->name . '-' . Auth::user()->name,
        ]);

        // attach both users to the conversation
        $new_conversation->users()->attach([$recipient->id, Auth::user()->id]);

        return redirect('conversations/' . $new_conversation->id)->with('message', 'conversation created succcessfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Conversation $conversation)
    {
        $messages = $conversation->messages;
        // dd($messages);

        return Inertia::render('Conversation/Show', [
            'conversation' => $conversation,
            'messages' => $messages,
        ]);
        // return response()->json($messages);
    }

    public function msgs(Conversation $conversation)
    {
        $messages = $conversation->messages();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(conversation $conversation)
    {
        $messages = $conversation->messages;

        return response()->json($messages);
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
