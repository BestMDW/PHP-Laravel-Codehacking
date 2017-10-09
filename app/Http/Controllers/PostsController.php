<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Get all posts.
        $posts = Post::paginate(2);

        // Get all categories.
        $categories = Category::all();

        // Load view from "resources\views\home.blade.php"
        return view('home', compact('posts', 'categories'));
    }
}
