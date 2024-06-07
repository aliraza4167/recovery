<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request);
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
    public function show(message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(message $message)
    {
        //
    }
}
