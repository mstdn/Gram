<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PostController extends Controller
{
    
    public function landing(Request $request)
    {
        return Inertia::render('Timeline/Home', [
            'posts' =>  PostResource::collection(Post::latest()->paginate(15)->withQueryString()),
            'filters' => $request->only(['search']),
        ]);
    }

    public function index(Request $request)
    {
        return Inertia::render('Timeline/Home', [
            'posts' =>  PostResource::collection(Post::query()->with('user', 'category')->latest()
            ->when($request->input('search'), function ($query, $search) {
                $query->where('description', 'like', "%{$search}%");
            })
            ->paginate(15)
            ->withQueryString()),
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
            'file'          => ['required','mimes:jpg,jpeg,png,gif','max:500048'],
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }


    public function destroy(Post $post)
    {
        if (!Gate::allows('delete-post', $post)) {
            abort(403);
        }
        $post->delete();
        return Redirect::route('home');
    }
}
