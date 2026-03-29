@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')
<div class="container">
    <h1 class="text-center mb-5">Новости</h1>
    
    @if(isset($articles) && count($articles) > 0)
        <div class="row">
            @foreach($articles as $article)
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if(isset($article['preview_image']))
                            @php
                                $slug = \Illuminate\Support\Str::slug($article['name']);
                            @endphp
                            <a href="{{ route('gallery', $slug) }}">
                                <img src="{{ asset($article['preview_image']) }}" 
                                     class="card-img-top" 
                                     alt="{{ $article['name'] }}"
                                     style="height: 200px; object-fit: cover;">
                            </a>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $article['name'] }}</h5>
                            <p class="card-text">{{ $article['shortDesc'] ?? 'Описание отсутствует' }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">{{ $article['date'] ?? 'Дата не указана' }}</small>
                                @php
                                    $slug = \Illuminate\Support\Str::slug($article['name']);
                                @endphp
                                <a href="{{ route('gallery', $slug) }}" class="btn btn-primary btn-sm">
                                    Читать далее
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center">
            Новостей пока нет
        </div>
    @endif
</div>
@endsection