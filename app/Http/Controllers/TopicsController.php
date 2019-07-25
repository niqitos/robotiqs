<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TopicsController extends Controller
{
    /**
     * Display a listing of the topic.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new topic.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created topic in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified topic.
     *
     * @param  Topic  $topic
     * @return Response
     */
    public function show(Topic $topic)
    {
        $articles = $topic->articles()->paginate(5);

        if (request()->expectsJson()) {
            return response()->json($articles);
        }
        
        return view('index', compact('articles', 'topic'));
    }

    /**
     * Show the form for editing the specified topic.
     *
     * @param  Topic  $topic
     * @return Response
     */
    public function edit(Topic $topic)
    {
        //
    }

    /**
     * Update the specified topic in storage.
     *
     * @param  Request  $request
     * @param  Topic  $topic
     * @return Response
     */
    public function update(Request $request, Topic $topic)
    {
        //
    }

    /**
     * Remove the specified topic from storage.
     *
     * @param  Topic  $topic
     * @return Response
     */
    public function destroy(Topic $topic)
    {
        //
    }
}
