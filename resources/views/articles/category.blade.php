@extends('layouts.app')

@section('title', 'Новости категории: ' . $currentCategory)

@section('content')
<div class="container">
    <h1 class="text-center mb-5">Новости категории: {{ $currentCategory }}</h1>
    @if($articles->count() > 0)
        <div class="row">
            @foreach($articles as $article)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if($article->preview_image)
                            <a href="{{ route('articles.show', $article->slug) }}">
                                <img src="{{ asset($article->preview_image) }}" 
                                     class="card-img-top" 
                                     alt="{{ $article->title }}"
                                     style="height: 200px; object-fit: cover;">
                            </a>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('articles.show', $article->slug) }}" 
                                   class="text-decoration-none text-dark">
                                    {{ $article->title }}
                                </a>
                            </h5>
                            <p class="card-text">{{ Str::limit($article->short_description, 100) }}</p>
                            <small class="text-muted">{{ $article->formatted_date }}</small>
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
            В этой категории пока нет новостей
        </div>
    @endif
</div>
@endsection