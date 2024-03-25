<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => fn () => $request->user()
                    ? $request->user()->only('id', 'name', 'email')
                    : null,
                'pains' => fn () => $request->user()
                    ? $request->user()->pains->map(fn ($pain) => [
                        'user_id' => $pain->user_id,
                        'name' => $pain->name,
                        'description' => $pain->description,
                        'when' => $pain->when
                    ])
                    : null,
                'profile' => fn () => $request->user()
                    ? $request->user()->profile->only('user_id', 'gender', 'description', 'story')
                    : null,
            ],
            // 'auth' => [
            //     'user' => $request->user(),
            // ],
        ];
    }
}
