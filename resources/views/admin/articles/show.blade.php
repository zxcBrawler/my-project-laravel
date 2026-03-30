@extends('layouts.app')

@section('title', $article->title)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="mb-4">
                <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">
                    Назад к списку
                </a>
                <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-warning">
                    Редактировать
                </a>
                <form action="{{ route('admin.articles.destroy', $article) }}" 
                      method="POST" 
                      class="d-inline"
                      onsubmit="return confirm('Удалить новость?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
            </div>
            <div class="card shadow-sm mb-4">
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
                        <div class="d-flex justify-content-between">
                            <div>
                                <small class="text-muted">
                                    <i class="bi bi-calendar"></i> {{ $article->formatted_date }}
                                </small>
                                <br>
                                <small class="text-muted">
                                    <i class="bi bi-eye"></i> {{ $article->views }} просмотров
                                </small>
                            </div>
                            <div>
                                @if($article->is_published)
                                    <span class="badge bg-success">Опубликовано</span>
                                @else
                                    <span class="badge bg-secondary">Черновик</span>
                                @endif
                                @if($article->category)
                                    <span class="badge bg-info">{{ $article->category }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h4>Краткое описание</h4>
                        <p class="lead">{{ $article->short_description }}</p>
                    </div>
                    
                    <div>
                        <h4>Полное содержание</h4>
                        <div class="article-content">
                            {!! nl2br(e($article->content)) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Комментарии ({{ $article->allComments()->count() }})</h4>
                    <div>
                        <span class="badge bg-success me-1">Одобрено: {{ $article->comments()->count() }}</span>
                        <span class="badge bg-warning text-dark">Ожидают: {{ $article->allComments()->where('is_moderated', false)->count() }}</span>
                        <span class="badge bg-danger">Отклонено: {{ $article->allComments()->where('is_approved', false)->where('is_moderated', true)->count() }}</span>
                    </div>
                </div>
                <div class="card-body">
                    @if($comments->count() > 0)
                        <div class="comments-list">
                            @foreach($comments as $comment)
                                <div class="card mb-3 {{ $comment->is_approved ? 'border-success' : ($comment->is_moderated ? 'border-danger' : 'border-warning') }}">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $comment->user->name }}</strong>
                                            <span class="text-muted ms-2">({{ $comment->user->email }})</span>
                                        </div>
                                        <div>
                                            @if($comment->is_approved)
                                                <span class="badge bg-success">Одобрен</span>
                                            @elseif($comment->is_moderated)
                                                <span class="badge bg-danger">Отклонен</span>
                                            @else
                                                <span class="badge bg-warning text-dark">На модерации</span>
                                            @endif
                                            <small class="text-muted ms-2">{{ $comment->created_at->format('d.m.Y H:i') }}</small>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">{{ $comment->content }}</p>
                                    </div>
                                    <div class="card-footer bg-white">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">
                                                <i class="bi bi-clock"></i> 
                                                Создан: {{ $comment->created_at->format('d.m.Y H:i') }}
                                                @if($comment->moderated_at)
                                                    <br><i class="bi bi-check-circle"></i> 
                                                    Модерирован: {{ $comment->moderated_at->format('d.m.Y H:i') }}
                                                    @if($comment->moderator)
                                                        модератором: {{ $comment->moderator->name }}
                                                    @endif
                                                @endif
                                            </small>
                                            
                                            @if(!$comment->is_moderated)
                                                <div class="d-flex gap-2">
                                                    <form action="{{ route('admin.comments.approve', $comment) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-success">
                                                            <i class="bi bi-check-lg"></i> Одобрить
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.comments.reject', $comment) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                                onclick="return confirm('Отклонить комментарий?')">
                                                            <i class="bi bi-x-lg"></i> Отклонить
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="d-flex justify-content-center mt-4">
                            {{ $comments->links() }}
                        </div>
                    @else
                        <div class="alert alert-info text-center">
                            Нет комментариев к этой статье
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection