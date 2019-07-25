@extends('layouts.app')

@section('title', $user->name)
@section('description', config('app.description'))
{{-- @section('author', config('app.author')}
{{-- @section('vk:image', $article->title) --}}
{{-- @section('twitter:image', $article->title) --}}
{{-- @section('og:image', $article->title) --}}

@section('content')
{{-- <div class="container"> --}}
    <div class="row">
        <div class="col-md-4 mb-3 mb-md-0">
            <div class="row d-flex align-items-center d-md-block">
                <div class="text-center col-12 col-sm-4 col-md-12 pb-md-5">
                    <span class="display-2">
                        @if($user->picture)
                            <img src="{{ $user->picture }}" alt="{{ $user->name }}" style="max-width:50%">
                        @else
                            <i class="far fa-user"></i>
                        @endif
                    </span>
                    <div class="my-2 my-sm-3">
                        {{ $user->name }}
                    </div>
                </div>
                <nav class="col-12 col-sm-8 col-md-12 sidebar px-0 px-sm-5 px-md-3 px-lg-5">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                            <a class="nav-link d-flex align-items-center justify-content-between {{ $type == 'articles' ? 'active' : null }}" href="{{ route('profile.articles', $user) }}">
                                    {{ __('Articles') }}
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center justify-content-between {{ $type == 'comments' ? 'active' : null }}" href="{{ route('profile.comments', $user) }}">
                                    {{ __('Comments') }}
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center justify-content-between {{ $type == 'likes' ? 'active' : null }}" href="{{ route('profile.likes', $user) }}">
                                    {{ __('Likes') }}
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <div class="col-md-8 px-0">
            @includeWhen(view()->exists("partials.{$type}"), "partials.{$type}") 
        </div>
    </div>
{{-- </div> --}}
@endsection
