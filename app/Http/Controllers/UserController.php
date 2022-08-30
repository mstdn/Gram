<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('User/Index', [
            'profiles'  =>  UserResource::collection(
                User::with('posts', 'likes', 'followers', 'followables')
                ->latest()
                ->when($request->input('searchUser'), function ($query, $searchUser) {
                    $query->where('description', 'like', "%{$searchUser}%");
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
            'profile'  =>  UserResource::make($user->load('posts', 'likes')),
            'filters' => $request->only(['search']),
        ]);
    }


    public function follow(User $user)
    {
        if (auth()->user()->isFollowing($user)) {
            auth()->user()->unfollow($user);
        } else {
            auth()->user()->toggleFollow($user);
        }

        return back();
    }
}
