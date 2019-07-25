@extends('layouts.app')

{{-- @section('title', config('app.name')) --}}
{{-- @section('description', config('app.description')) --}}
@section('author', config('app.author'))
{{-- @section('vk:image', $article->title) --}}
{{-- @section('twitter:image', $article->title) --}}
{{-- @section('og:image', $article->title) --}}

@section('content')
    @if($routeIsTopic)
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="h2">{{ $topic->name }}</h1>
            </div>
        </div>
    @endif
        
    <articles endpoint="{{ url()->current() }}"></articles>
@endsection
