<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Categories/Index', [
            'explore'    =>  Category::query()
            ->with('posts')
            ->latest()
            ->paginate(20)
            ->through(fn($category) => [
                'id'    =>  $category->id,
                'name'  =>  $category->name,
                'slug'  =>  $category->slug,
                'count' =>  $category->posts->count()
            ]),
            'filters' => $request->only(['search']),
        ]);
    }

    public function show(Request $request, Category $category) 
    {
        return Inertia::render('Categories/Show', [
            'posts'  =>  PostResource::collection($category->posts->load('category', 'user')),
            'category'  =>  $category->name,
            'filters' => $request->only(['search'])
        ]);
    }
}
