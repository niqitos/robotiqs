<?php

namespace App\Http\Controllers;

use App\Article;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class ArticlesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
    
    /**
     * Display a listing of the articles.
     *
     * @return Response
     */
    public function index()
    {
        $articles = Article::filter()->paginate(5);

        if (request()->expectsJson()) {
            return response()->json($articles);
        }
        
        return view('index');
    }

    /**
     * Show the form for creating a new article.
     *
     * @return Response
     */
    public function create()
    {        
        return view('articles.create');
    }

    /**
     * Store a newly created article in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'topic_id' => 'required|exists:topics,id',
        ]);

        $slug = Str::slug(strip_tags($request->title));

        $existingCount = Article::where('slug', 'like', "{$slug}%")->count();

        if ($existingCount) {
            $slug = "{$slug}-{$existingCount}";
        }

        $article = Article::create([
            'user_id' => auth()->id(),
            'topic_id' => $request->topic_id,
            'slug' => $slug,
            'title' => strip_tags($request->title),
            'body' => $request->body,
        ]);

        if (request()->expectsJson()) {
            return $article->load('topic', 'author');
        }

        return redirect()->route('article.show', [$article->topic, $article])
            ->with('flash.type', __('success'))
            ->with('flash.message', __('Your article has been published.'));
    }

    /**
     * Display the specified article.
     *
     * @param  Article  $article
     * @param  Topic  $topic
     * @return Response
     */
    public function show(Topic $topic, Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified article.
     *
     * @param  Article  $article
     * @return Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified article in storage.
     *
     * @param  Request  $request
     * @param  Article  $article
     * @return Response
     */
    public function update(Request $request, Article $article)
    {
        $this->authorize('update', $article);

        $article->update([
            'topic_id' => $request->topic_id,
            'title' => $request->title,
            'body' => $request->body,
        ]);
    }

    /**
     * Remove the specified article from storage.
     *
     * @param  Article  $article
     * @return Response
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        $article->delete();

        return redirect()->route('index');
    }
}
