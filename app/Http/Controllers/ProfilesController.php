<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Article;
use App\Comment;
use App\User;

class ProfilesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Display the specified profile.
     *
     * @param  User  $user
     * @return Response
     */
    public function show(User $user)
    {
        switch (collect(request()->segments())->last()) {
            case 'articles':
                $type = 'articles';
                break;
            case 'comments':
                $type = 'comments';
                break;
            case 'liked':
                $type = 'likes';
                break;
            default:
                $type = 'articles';
        }
        
        $activities = $user->activity()->feed()->paginate(5);
        

        if (request()->expectsJson()) {
            return response()->json($activities);
        }

        return view('profiles.show', compact('user', 'type'));
    }
}
