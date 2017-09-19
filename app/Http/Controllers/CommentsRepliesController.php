<?php

namespace App\Http\Controllers;

use App\Comment;
use App\CommentReply;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class CommentsRepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /******************************************************************************************************************/

    public function createReply(Request $request)
    {
        // Get logged in user.
        $user = Auth::user();
        // Create a new comment.
        CommentReply::create([
            'comment_id' => $request->comment_id,
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
        // Find specific comment.
        $comment = Comment::findOrFail($id);
        // Get all replies for this comment.
        $replies = $comment->replies()->paginate(15);

        // Load view from "resources\views\admin\comments\replies\show.blade.php"
        return view('admin.comments.replies.show', compact('replies'));
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
        CommentReply::findOrFail($id)->update($request->all());

        // Redirect to the previous page.
        return redirect()->back();
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
        CommentReply::findOrFail($id)->delete();

        // Redirect to the previous page.
        return redirect()->back();
    }
}
