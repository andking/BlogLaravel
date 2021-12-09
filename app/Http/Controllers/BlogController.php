<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $categories = Category::orderby('title')->get();
        $posts = Post::paginate(4);
        return view('pages.index', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }

    public function getPostsByCategory($slug)
    {
        $categories = Category::orderby('title')->get();
        $current_category = Category::where('slug', $slug)->first();

        return view('pages.index', [
            'posts' => $current_category->posts()->paginate(4),
            'categories' => $categories,
        ]);
    }
}
