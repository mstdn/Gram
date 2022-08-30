<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function store(User $user)
    {
        return $user->id === 1;
    }

    public function destroy(User $user)
    {
        return $user->id === 1;
    }
}
