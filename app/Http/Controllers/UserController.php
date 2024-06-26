<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function indexFriend()
    {
        return Inertia::render('Friend/Index', [
            'friends' => Auth::user()->friends->map(fn ($friend) => [
                'id' => $friend->id,
                'name' => $friend->name,
                'profile' => $friend->profile
            ])
        ]);
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
        // Auth::user()->friends()->attach($request->friend);

        // return to_route('friends.index');
    }

    public function storeFriend(Request $request)
    {
        Auth::user()->friends()->attach($request->friend);

        return redirect('/friends');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $pains = $user->pains;
        $profile = $user->profile;
        return Inertia::render('UserPublicProfile', [
            'user' => $user->only('id', 'name'),
            'pains' => $pains->map(fn ($pain) => [
                'user_id' => $pain->user_id,
                'name' => $pain->name,
                'description' => $pain->description,
                'when' => $pain->when,
            ]),
            'profile' => $profile->only('user_id', 'gender', 'description', 'story'),
        ]);
    }

    public function showFriend(string $id)
    {
        return Inertia::render('Friend/Show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Auth::user()->friends()->detach([$id]);

        // return redirect("/friends");
    }

    public function destroyFriend(string $id)
    {
        Auth::user()->friends()->detach([$id]);

        return redirect("/friends");
    }
}
