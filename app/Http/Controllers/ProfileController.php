<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilePainRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Ache;
use App\Models\Pain;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Profile;
use Carbon\Carbon;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        $aches = Ache::all()->map(fn ($ache) => [
            'ache_id' => $ache->id,
            'name' => $ache->name,
            'when' => $ache->when
        ]);
        $profile = Auth::user()->profile->only('user_id', 'gender', 'description', 'story');

        return Inertia::render('Profile/Edit', [
            'aches' => $aches,
            // 'pains' => Auth::user()->pains,
            // 'profileData' => $profile,
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required',
            'story' => 'required',
            'gender' => 'required'
        ]);

        Profile::create([
            'description' => $validated['description'],
            'story' => $validated['story'],
            'gender' => $validated['gender'],
            'user_id' => Auth::user()->id
        ]);

        return Redirect::route('profile.edit');
    }


    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // dd($request->user()->profile);
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $validated = $request->validate([
            // 'name' => 'required|max:255',
            // 'email' => 'required|email:rfc,dns',
            'description' => 'required',
            'story' => 'required',
            'gender' => 'required'
        ]);

        $request->user()->save();
        $request->user()->profile->update([
            'description' => $validated['description'],
            'story' => $validated['story'],
            'gender' => $validated['gender'],
        ]);

        return Redirect::route('profile.edit');
    }

    public function updatePainDetails(ProfilePainRequest $request)
    {
        // dd($request->painName);
        // Auth::user()->a()->attach([$validated['suffer_id']]);
        $converted_date = Carbon::parse($request->painWhen);
        // $converted_date = strtotime($request->painWhen);

        Pain::create([
            'name' => $request->painName,
            'description' => $request->painDescription,
            'when' => $converted_date,
            'user_id' => Auth::user()->id
        ]);

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
