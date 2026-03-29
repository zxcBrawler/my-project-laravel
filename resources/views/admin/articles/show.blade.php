@extends('layouts.app')

@section('title', $article->title)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="mb-4">
                <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">
                    Назад к списку
                </a>
                <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-warning">
                    Редактировать
                </a>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h1 class="h3 mb-0">{{ $article->title }}</h1>
                </div>
                <div class="card-body">
                    @if($article->full_image)
                        <div class="text-center mb-4">
                            <img src="{{ asset($article->full_image) }}" 
                                 class="img-fluid rounded" 
                                 alt="{{ $article->title }}">
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
        </div>
    </div>
</div>
@endsection