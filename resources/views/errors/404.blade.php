@extends('layouts.app')

@section('title', __('404'))
@section('description', __('Not Found'))
@section('author', config('app.author'))
{{-- @section('vk:image', $article->title) --}}
{{-- @section('twitter:image', $article->title) --}}
{{-- @section('og:image', $article->title) --}}

@section('content')
    <div style="padding-top: 35vh;">
        <h1 class="h4 text-center">{{ __('404') }}</h1>
    </div>
@endsection
