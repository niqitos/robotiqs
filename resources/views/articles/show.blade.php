@extends('layouts.app')

@section('title', $article->title)
@section('description', $article->description)
@section('author', $article->author->name)
{{-- @section('vk:image', $article->title) --}}
{{-- @section('twitter:image', $article->title) --}}
{{-- @section('og:image', $article->title) --}}

@section('content')
    <article-view :article="{{ $article }}" :topics="{{ $topics }}"  update-endpoint="{{ route('article.update', $article) }}" inline-template v-cloak>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <article class="show">
                    <header class="px-0">
                        <div class="header-options">
                            <div class="form-group pr-3" style="width:250px" v-if="editing">
                                <v-select :options="selectOptions" :clearable="false" placeholder="{{ __('Topic') }}" v-model="topic" label="name" item-value="id" item-text="name"></v-select>
                            </div>
                            <div >
                                <a href="{{ route('topic.show', $article->topic) }}" class="text-decoration-none d-inline-flex align-items-center mr-3" v-if="!editing">
                                    <span v-html="topic.name">{{-- {{ $article->topic->name }} --}}</span>
                                </a>
                                <a href="{{ route('profile.articles', $article->author) }}" class="font-weight-bold mr-3">
                                    {{ $article->author->name }}
                                </a>
                            </div>
                            <time class="text-muted pt-2 pt-sm-0">
                                {{ $article->created_at->diffForHumans() }}
                            </time>
                        </div>
                        <medium-editor :text='title' :options='optionsTitle' custom-tag='h1' v-if="editing" @edit="titleEdit"></medium-editor>
                        <h1 class="my-2" v-if="!editing" v-html="title">{{-- {{ $article->title }} --}}</h1>
                    </header>
                    <div class="article-body px-0">
                        <medium-editor v-if="editing" :text='body' :options='optionsBody' @edit='bodyEdit'></medium-editor>

                        <div v-else v-html="body"></div>
                        {{-- {!! $article->body !!} --}}
                    </div>
                    <div class="article-options px-0">
                        <like :subject="{{ $article }}" login-endpoint="{{ route('login') }}" like-endpoint="{{ route('like', ['article', $article]) }}" v-if="!editing"></like>
                        <read article="{{ $article->title . strip_tags($article->body) }}" v-if="!editing"></read>

                        @can('update', $article)
                            <button class="btn btn-sm border-0 p-0 mr-3" v-if="!editing" @click="editing = true">Редактировать</button>

                            <button class="btn btn-sm border-0 p-0 mr-3" v-if="editing" @click="update">Обновить</button>
                            <button class="btn btn-sm border-0 p-0 text-muted" v-if="editing" @click="editing = false">Отменить</button>
                        @endcan

                        @can('delete', $article) 
                            <form action="{{ route('article.destroy', $article) }}" method="POST" v-if="!editing">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn text-danger btn-sm">
                                    {{ __('Delete') }}
                                </button>
                            </form>
                        @endcan
                    </div>
                </article>
                
                <h5 id="comments" class="mb-3 mt-5">
                    <span v-text="commentsCount"></span>
                    {{ $article->commentsDeclension() }}
                </h5>
                
                <comments store-comment-endpoint="{{ route('comment.store', $article) }}" login-endpoint="{{ route('login') }}" get-comments-endpoint="{{ route('comments.index', $article) }}" :article="{{ $article }}" @added="commentsCount++" @removed="commentsCount--"></comments>
            </div>
        </div>
    </article-view>
@endsection

@section('scripts')
<script>
    
</script>
@endsection
