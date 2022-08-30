<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{

    public function landing(Request $request)
    {
        return Inertia::render('Timeline/Home', [
            'posts' =>  PostResource::collection(Post::latest()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('description', 'like', "%{$search}%");
                })
                ->paginate(15)->withQueryString()),
            'filters' => $request->only(['search']),
        ]);
    }

    public function index(Request $request, Post $post)
    {
        return Inertia::render('Timeline/Home', [
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $post = $request->validate([
            'description'   =>  'required|min:1|max:500',
            'file'          => ['required', 'mimes:jpg,jpeg,png,gif', 'max:500048'],
            'category'      =>  ['required', Rule::exists('categories', 'id')],
        ]);

        $post['user_id'] = auth()->id();

        $post = Post::create([
            'user_id'       =>  auth()->id(),
            'description'   =>  $request->description,
            'category_id'   =>  $request->category,
            'file'          =>  $request->file->store('uploads/' . $post['user_id'] . '/' . 'images', 'public'),
        ]);

        return Redirect::route('home');
    }


    public function show(Post $post, Request $request)
    {
        return Inertia::render('Post/Show', [
            'post'  =>  PostResource::make($post),
            'filters' => $request->only(['search'])
        ]);
    }


    public function edit(Post $post)
    {
        //
    }


    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    public function like(Post $post)
    {
        if (auth()->user()->hasLiked($post)) {
            auth()->user()->unlike($post);
        } else {
            auth()->user()->toggleLike($post);
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
