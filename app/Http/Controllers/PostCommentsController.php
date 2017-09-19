<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class PostCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all comments.
        $comments = Comment::paginate(15);

        // Load view from "resources\views\admin\comments\index.blade.php"
        return view('admin.comments.index', compact('comments'));
    }

    /******************************************************************************************************************/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /******************************************************************************************************************/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Get logged in user.
        $user = Auth::user();
        // Create a new comment.
        Comment::create([
            'post_id' => $request->post_id,
            'author' => $user->name,
            'email' => $user->email,
            'photo' => $user->photo->path,
            'body' => $request->body,
        ]);

        // Save message for later show.
        $request->session()->flash('comment_message', 'Your message has been submitted and is waiting moderation.');

        // Redirect back to the post.
        return redirect()->back();
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
        // Find post with specific ID.
        $post = Post::findOrFail($id);
        // Get all post's comments.
        $comments = $post->comments()->paginate(15);

        // Load view from "resources\views\admin\comments\show.blade.php"
        return view('admin.comments.show', compact('comments'));
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
        // Find and update comment with specific ID.
        Comment::findOrFail($id)->update($request->all());

        // Redirect to the list of the comments.
        return redirect()->route('admin.comments.index');
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
        // Find and delete comment with specific ID.
        Comment::findOrFail($id)->delete();

        // Redirect to the previous page.
        return redirect()->back();
    }
}
