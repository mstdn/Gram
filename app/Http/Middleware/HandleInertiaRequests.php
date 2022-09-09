<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Inertia\Middleware;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [

            'appName' => config('app.name'),

            'auth.user' => fn () => $request->user()
                ? $request->user()->only('id', 'name', 'username')
                : null,

            'flash' => [
                'message' => fn () => $request->session()->get('message')
            ],

            'categories' => fn () => Category::latest()
                ->get()
                ->map(fn ($category) => [
                    'id'    =>  $category->id,
                    'name'  =>  $category->name,
                    'slug'  =>  $category->slug
                ]),

            'filters' => $request->only(['search']),

            'unreadNotificationsCount' => $request->user() ? $request->user()->unreadNotifications()->count() : null,

            /* 'posts'  => fn () => [
                'posts' =>  PostResource::collection(Post::query()->with('user', 'category')->latest()
                    ->when($request->input('search'), function ($query, $search) {
                        $query->where('description', 'like', "%{$search}%");
                    })
                    ->paginate(25)
                    ->withQueryString()),
                'filters' => $request->only(['search'])
            ] */

        ]);
    }
}
