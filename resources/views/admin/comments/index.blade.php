@extends('layouts.app')

@section('title', 'Модерация комментариев')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Модерация комментариев</h1>
        <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">
            Назад к статьям
        </a>
    </div>
    @if($comments->count() > 0)
        <div class="row">
            @foreach($comments as $comment)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-warning text-dark">
                            <div class="d-flex justify-content-between align-items-center">
                                <strong>{{ $comment->user->name }}</strong>
                                <small>{{ $comment->created_at->format('d.m.Y H:i') }}</small>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ $comment->content }}</p>
                            <hr>
                            <small class="text-muted">
                                Статья: <a href="{{ route('admin.articles.show', $comment->article) }}">
                                    {{ Str::limit($comment->article->title, 50) }}
                                </a>
                            </small>
                        </div>
                        <div class="card-footer bg-white">
                            <div class="d-flex gap-2">
                                <form action="{{ route('admin.comments.approve', $comment) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="bi bi-check-lg"></i> Одобрить
                                    </button>
                                </form>
                                <form action="{{ route('admin.comments.reject', $comment) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" 
                                            onclick="return confirm('Отклонить комментарий?')">
                                        <i class="bi bi-x-lg"></i> Отклонить
                                    </button>
                                </form>
                            </div>
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
            Нет комментариев, ожидающих модерации
        </div>
    @endif
</div>
@endsection