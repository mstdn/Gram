<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Resources\PostResource;
use App\Http\Resources\ReplyResource;
use App\Models\Media;
use App\Models\Reply;
use App\Notifications\LikeNotification;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    public function landing(Request $request)
    {
        return Inertia::render('Timeline/Public', [
            'posts' =>  PostResource::collection(
                Post::query()
                    ->select('id', 'description', 'file', 'category_id', 'user_id', 'created_at')
                    ->with('user', 'category', 'replies')
                    ->latest()
                    ->when($request->input('search'), function ($query, $search) {
                        $query->where('description', 'like', "%{$search}%");
                    })
                    ->paginate(15)
                    ->withQueryString()
            ),
            'filters' => $request->only(['search']),
        ]);
    }

    public function index(Request $request)
    {
        return Inertia::render('Timeline/Home', [
            'posts' => PostResource::collection(
                Post::where(function ($query) {
                    $query->where('user_id', auth()->id())
                        ->orWhereIn('user_id', auth()->user()->followings->pluck('followable_id'));
                })
                    //->select('id', 'description', 'file', 'category_id', 'user_id', 'created_at')
                    ->with('user', 'replies', 'likers', 'media', 'category')
                    ->latest()
                    ->when($request->input('search'), function ($query, $search) {
                        $query->where('description', 'like', "%{$search}%");
                    })
                    ->paginate(20)
                    ->withQueryString()
            ),
            'filters' => $request->only(['search'])
        ]);
    }

    public function public(Request $request)
    {
        return Inertia::render('Timeline/Public', [
            'posts' =>  PostResource::collection(
                Post::query()
                    ->select('id', 'description', 'file', 'category_id', 'user_id', 'created_at')
                    ->with('user', 'category', 'replies')
                    ->latest()
                    ->when($request->input('search'), function ($query, $search) {
                        $query->where('description', 'like', "%{$search}%");
                    })
                    ->paginate(15)
                    ->withQueryString()
            ),
            'filters' => $request->only(['search'])
        ]);
    }

    public function create()
    {
        return Inertia::render('Post/Create');
    }

    public function store(Request $request)
    {
        $post = $request->validate([
            'description'   =>  'required|min:1|max:500',
            'category'      =>  ['required', Rule::exists('categories', 'id')],
            'mediaIds.*'    =>  [
                'required',
                Rule::exists('media', 'id')
                    ->where(function ($query) use ($request) {
                        $query->where('user_id', $request->user()->id);
                    })
            ]
        ]);

        if ($request->mediaIds) {
            $post = Post::create([
                'user_id'       =>  $request->user()->id,
                'description'   =>  $request->description,
                'category_id'   =>  $request->category,
            ]);
        }

        Media::find($request->mediaIds)->each->update([
            'model_id'      =>  $post->id,
            'model_type'    =>  Post::class
        ]);

        return redirect(route('home'));
    }

    public function show(Post $post, Request $request)
    {
        return Inertia::render('Post/Show', [
            'post'      =>  PostResource::make($post),
            'replies'   =>  ReplyResource::collection(
                Reply::where('post_id', $post->id)
                    ->with('user')
                    ->oldest()
                    ->paginate()
            ),
            'filters'   => $request->only(['search'])
        ]);
    }

    public function like(Post $post)
    {
        if (auth()->user()->hasLiked($post)) {
            auth()->user()->unlike($post);
        } else {
            auth()->user()->toggleLike($post);
            $post->user->notify(new LikeNotification($post, auth()->user()));
        }
        return back();
    }

    public function destroy(Post $post)
    {
        if (!Gate::allows('delete-post', $post)) {
            abort(403);
        }

        if (File::exists('storage' . $post->file)) {
            File::delete('storage' . $post->file);
        }

        $post->delete();
        return Redirect::route('home');
    }
}
