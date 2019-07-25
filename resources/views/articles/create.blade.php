@extends('layouts.app')

@section('title', __('Write an article'))
@section('description', config('app.description'))
@section('author', config('app.author'))
{{-- @section('vk:image', $article->title) --}}
{{-- @section('twitter:image', $article->title) --}}
{{-- @section('og:image', $article->title) --}}

@section('content')
    <article-create 
        :topics="{{ $topics }}" 
        endpoint="{{ route('article.store') }}" 
        placeholder-select="{{ __('Topic') }}" 
        placeholder-title="{{ __('Title') }}" 
        placeholder-body="{{ __('Details...') }}" 
        button-name="{{ __('Publish') }}"
    ></article-create>
@endsection
