<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LikeNotification extends Notification
{
    use Queueable;

    public function __construct(Post $post, User $user)
    {
        $this->post = $post;
        $this->user = $user;
        $this->follower = Auth::user();
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'user' => [
                'id'            =>  $this->user->id,
                'name'          =>  $this->user->name,
                'username'      =>  $this->user->username,
                'avatar'        =>  $this->user->getProfilePhotoUrlAttribute(),
            ],
            'post'              =>  PostResource::make($this->post),
            'type'              =>  'like',
            'follower'  =>  [
                'id'            =>  $this->follower->id,
                'name'          =>  $this->follower->name,
                'username'      =>  $this->follower->username,
                'avatar'        =>  $this->follower->getProfilePhotoUrlAttribute(),
            ],
        ];
    }
}
