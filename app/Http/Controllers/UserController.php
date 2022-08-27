<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function show(User $user, Request $request)
    {
        return Inertia::render('User/Show', [
            'profile'  =>  UserResource::make($user),
            'filters' => $request->only(['search']),
        ]);
    }
}
