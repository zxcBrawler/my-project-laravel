@extends('layouts.app')

@section('title', $article->title)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="mb-4">
                <a href="{{ route('articles.index') }}" class="btn btn-secondary">
                    Назад к новостям
                </a>
            </div>
            
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h1 class="h3 mb-0">{{ $article->title }}</h1>
                </div>
                <div class="card-body">
                    @if($article->full_image)
                        <div class="text-center mb-4">
                            <img src="{{ asset($article->full_image) }}" 
                                 class="img-fluid rounded" 
                                 alt="{{ $article->title }}"
                                 style="max-height: 500px; width: auto;">
                        </div>
                    @endif
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted">
                                <i class="bi bi-calendar"></i> {{ $article->formatted_date }}
                            </div>
                            <div class="text-muted">
                                <i class="bi bi-eye"></i> {{ $article->views }} просмотров
                            </div>
                            @if($article->category)
                                <div>
                                    <a href="{{ route('articles.category', $article->category) }}" 
                                       class="badge bg-secondary text-decoration-none">
                                        {{ $article->category }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h4>Краткое описание</h4>
                        <p class="lead">{{ $article->short_description }}</p>
                    </div>
                    
                    <div class="mb-4">
                        <h4>Полный текст</h4>
                        <div class="article-content">
                            {!! nl2br(e($article->content)) !!}
                        </div>
                    </div>
                </div>
            </div>
            
            @if($relatedArticles->count() > 0)
                <div class="mt-5">
                    <h3 class="mb-4">Похожие новости</h3>
                    <div class="row">
                        @foreach($relatedArticles as $related)
                            <div class="col-md-4 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="{{ route('articles.show', $related->slug) }}" 
                                               class="text-decoration-none">
                                                {{ $related->title }}
                                            </a>
                                        </h5>
                                        <small class="text-muted">{{ $related->formatted_date }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection