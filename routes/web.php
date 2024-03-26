<?php

use App\Http\Controllers\FriendController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    // dd(Auth::user()->friends()->get()->pluck('id'));
    // dd(Auth::user()->id);
    $idsToAvoid = Auth::user()->friends()->get()->pluck('id')->toArray();
    array_push($idsToAvoid, Auth::user()->id);
    // dd($idsToAvoid);
    return Inertia::render('Dashboard', [
        'users' => User::all()->except($idsToAvoid)->map(fn ($user) => [
            'id' => $user->id,
            'name' => $user->name,
        ])
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/friends', [UserController::class, 'indexFriend']);
    Route::post('/friends/{friend}', [UserController::class, 'storeFriend']);
    Route::delete('/friends/{friend}', [UserController::class, 'destroyFriend']);
});

// Route::resource('friends', FriendController::class);
Route::resource('posts', PostController::class);

// Route::get('/friends/add', function ($request) {
//     dd($request);
//     Auth::user()->friends()->attach($request['id']);

//     return to_route('dashboard');
// })->middleware(['auth', 'verified']);

Route::get('/publish_hub', function () {
    return Inertia::render('Publish_Hub');
})->middleware(['auth', 'verified'])->name('publish_hub');

Route::get('/conversations', function () {
    return Inertia::render('Conversations');
})->middleware(['auth', 'verified'])->name('conversations');

Route::get('/user/{id}', function ($id) {
    $user = User::findorfail($id);
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
})->middleware('auth')->name('public.profile');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/pain', [ProfileController::class, 'updatePainDetails'])->name('profile.painUpdate');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
