@extends('layouts.app')

@section('title', 'Все новости')

@section('content')
<div class="container">
    <h1 class="text-center mb-5">Все новости</h1>
    @if($articles->count() > 0)
        <div class="row">
            @foreach($articles as $article)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm d-flex flex-column">
                        @if($article->preview_image)
                            <a href="{{ route('articles.show', $article->slug) }}">
                                <img src="{{ asset($article->preview_image) }}" 
                                     class="card-img-top" 
                                     alt="{{ $article->title }}"
                                     style="height: 200px; object-fit: cover;">
                            </a>
                        @endif
                        <div class="card-body flex-grow-1">
                            <h5 class="card-title">
                                <a href="{{ route('articles.show', $article->slug) }}" 
                                   class="text-decoration-none text-dark">
                                    {{ $article->title }}
                                </a>
                            </h5>
                            <p class="card-text">{{ Str::limit($article->short_description, 100) }}</p>                           
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted">
                                        <i class="bi bi-calendar"></i> {{ $article->formatted_date }}
                                    </small>
                                    <br>
                                    <small class="text-muted">
                                        <i class="bi bi-eye"></i> {{ $article->views }} просмотров
                                    </small>
                                </div>
                                @if($article->category)
                                    <a href="{{ route('articles.category', $article->category) }}" 
                                       class="badge bg-secondary text-decoration-none">
                                        {{ $article->category }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer bg-white border-top-0 pt-0 pb-3">
                            <a href="{{ route('articles.show', $article->slug) }}#comments" 
                               class="text-decoration-none text-muted comment-count">
                                <i class="bi bi-chat-dots"></i> 
                                Комментарии: {{ $article->comments_count ?? $article->comments()->count() }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="text-center mt-4">
            {{ $articles->links() }}
        </div>
    @else
        <div class="alert alert-info text-center">
            Новостей пока нет
        </div>
    @endif
</div>
@endsection