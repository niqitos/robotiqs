@extends('layouts.app')

@section('title', __('Privacy Policy'))
@section('description', config('app.description'))
@section('author', config('app.author'))
{{-- @section('vk:image', $article->title) --}}
{{-- @section('twitter:image', $article->title) --}}
{{-- @section('og:image', $article->title) --}}

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Политика конфиденциальности</h1>
        </div>
    </div>
@endsection