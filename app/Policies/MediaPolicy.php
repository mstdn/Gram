<?php

namespace App\Policies;

use App\Models\Media;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MediaPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Media $media)
    {
        return $user->id === $media->user_id;
    }

    public function destroy(User $user, Media $media)
    {
        return $user->id === $media->user_id;
    }
}
