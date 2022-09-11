<?php

namespace App\Http\Controllers;

use App\Http\Resources\FollowerResource;
use App\Http\Resources\FollowResource;
use App\Models\Post;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Notifications\FollowNotification;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('User/Index', [
            'profiles'  =>  UserResource::collection(
                User::with('posts', 'likes', 'followers', 'followables')
                    ->latest()
                    ->when($request->input('searchUsers'), function ($query, $searchUsers) {
                        $query->where('name', 'like', "%{$searchUsers}%");
                    })
                    ->paginate(15)
                    ->withQueryString()
            ),
            'search' => $request->only(['searchUsers']),
            'filters' => $request->only(['search'])
        ]);
    }

    public function show(User $user, Request $request)
    {
        return Inertia::render('User/Show', [
            'profile'   =>  UserResource::make(
                $user->load('followers', 'followables')
                //->withCount(['followings', 'followables'])
            ),
            'posts'     =>  PostResource::collection(
                $user->posts()->latest()
                    ->select('id', 'description', 'file', 'category_id', 'user_id', 'created_at')
                    ->with('user', 'replies', 'likers', 'category')
                    ->paginate(15)
            ),
            'filters'   => $request->only(['search']),
            'likes'     =>  $user->likes()->with('likeable')->paginate(20)
            /* 'likes'     => PostResource::collection(
                Post::query()
                ->where('post_id', $user->likes())
                ->paginate(20)
            ) */
        ]);
    }

    public function follows(User $user, Request $request)
    {
        return Inertia::render('User/Follows', [
            'profile'   =>  UserResource::make(
                $user->load('followers', 'followables')
            ),
            'filters'       =>  $request->only(['search']),
            'follows'       =>  FollowResource::collection(
                $user->followings()
                    ->latest()
                    ->paginate()
            ),
        ]);
    }

    public function followers(User $user, Request $request)
    {
        return Inertia::render('User/Followers', [
            'profile'   =>  UserResource::make(
                $user->load('followers', 'followables')
            ),
            'filters'       =>  $request->only(['search']),
            'followers'     =>  FollowerResource::collection(
                $user->followers()
                    ->latest()
                    ->paginate()
            ),
        ]);
    }

    public function follow(User $user)
    {
        if (auth()->user()->isFollowing($user)) {
            auth()->user()->unfollow($user);
        } else {
            auth()->user()->toggleFollow($user);
            $user->notify(new FollowNotification($user, auth()->user()));
        }

        return back();
    }
}
