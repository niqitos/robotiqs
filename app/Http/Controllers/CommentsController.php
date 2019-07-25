<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }
    
    /**
     * Display a listing of the comment.
     *
     * @return Response
     */
    public function index(Article $article)
    {
        $comments = $article->comments()->paginate(5);

        if (request()->expectsJson()) {
            return response()->json($comments);
        }
    }

    /**
     * Show the form for creating a new comment.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created comment in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Article $article)
    {
        $this->validate(request(), [
            'body' => 'required'
        ]);

        $comment = $article->addComment([
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);

        if (request()->expectsJson()) {
            return $comment->load('creator');
        }

        return back()->with('flash.type', __('success'))
            ->with('flash.message', __('Your reply has been left.'));
    }

    /**
     * Display the specified comment.
     *
     * @param  Comment  $comment
     * @return Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified comment.
     *
     * @param  Comment  $comment
     * @return Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified comment in storage.
     *
     * @param  Request  $request
     * @param  Comment  $comment
     * @return Response
     */
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);
        
        $comment->update([
            'body' => $request->body
        ]);
    }

    /**
     * Remove the specified comment from storage.
     *
     * @param  Comment  $comment
     * @return Response
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('update', $comment);

        $comment->delete();

        if (request()->expectsJson()) {
            return response([
                'status' => 'Comment has been deleted!'
            ]);
        }

        return back();
    }
}
