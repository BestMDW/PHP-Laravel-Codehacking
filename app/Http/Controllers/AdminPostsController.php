<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostsRequest;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all posts.
        $posts = Post::all();
        // Get placeholder path.
        $placeholder = Photo::PLACEHOLDER;

        // Load view from "resources\views\admin\posts\index.blade.php"
        return view('admin.posts.index', compact('posts', 'placeholder'));
    }

    /******************************************************************************************************************/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Load view from "resources\views\admin\posts\create.blade.php"
        return view('admin.posts.create');
    }

    /******************************************************************************************************************/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsRequest $request)
    {
        // Get all data from the post.
        $input = $request->all();

        // Get current user.
        $user = Auth::user();

        // Check if file is uploaded.
        if ($file = $request->file('photo_id')) {
            // Add random string before file name for making sure the file name is unique.
            $name = time() . $file->getClientOriginalName();
            // Move uploaded file into the uploads directory.
            $file->move(Photo::UPLOAD_DIRECTORY, $name);
            // Create new record in database for the photo and assign that specific row with variable.
            $photo = Photo::create(['path' => $name]);
            // Update request with added photo id.
            $input['photo_id'] = $photo->id;
        }

        // Create post by using relation.
        $user->posts()->create($input);

        // Redirect to the posts list in the administrator panel.
        return redirect()->route('admin.posts.index');
    }

    /******************************************************************************************************************/

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /******************************************************************************************************************/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //


        // Load view from "resources\views\admin\posts\edit.blade.php"
        return view('admin.posts.edit');
    }

    /******************************************************************************************************************/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /******************************************************************************************************************/

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
