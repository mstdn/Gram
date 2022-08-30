<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Post;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Categories/Index', [
            'explore'    =>  CategoryResource::collection(
                Category::query()
                ->with('posts')
                ->latest()
                ->paginate(20)
                ),
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

    public function store(Request $request, Category $category)
    {
        if (!Gate::allows('create-category', $category)) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|max:80|min:1|unique:categories',
            'slug' => 'required|max:80|min:1|unique:categories'
        ]);

        Category::create([
            'name'  => $request['name'],
            'slug'  =>  $request['slug']
        ]);

        return Redirect::route('categories');
    }

    public function destroy(Category $category)
    {
        if (!Gate::allows('delete-category', $category)) {
            abort(403);
        }
        
        $category->delete();
        return Redirect::route('categories');
    }
}
