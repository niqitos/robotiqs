<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Article;
use App\LikeableModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LikesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created like in storage.
     *
     * @param  LikeableModel $likeable
     */
    public function store($type, LikeableModel $likeable)
    {
        $likeable->like();
    }

    /**
     * Remove the specified like from storage.
     *
     * @return LikeableModel $likeable
     */
    public function destroy($type, LikeableModel $likeable)
    {
        $likeable->unlike();
    }
}
