@extends('layouts.app')

@section('title', $article['name'] ?? 'Галерея')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="mb-4">
                <a href="{{ route('home') }}" class="btn btn-secondary">
                    Назад к новостям
                </a>
            </div>
            
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">{{ $article['name'] }}</h3>
                </div>
                <div class="card-body">
                    @if(isset($article['full_image']))
                        <div class="text-center mb-4">
                            <img src="{{ asset($article['full_image']) }}" 
                                 class="img-fluid rounded" 
                                 alt="{{ $article['name'] }}"
                                 style="max-height: 500px; width: auto;">
                        </div>
                    @endif
                    
                    @if(isset($article['date']))
                        <div class="text-muted mb-3">
                            <small>Дата публикации: {{ $article['date'] }}</small>
                        </div>
                    @endif
                    
                    @if(isset($article['shortDesc']))
                        <div class="mb-4">
                            <h4>Краткое описание</h4>
                            <p>{{ $article['shortDesc'] }}</p>
                        </div>
                    @endif
                    
                    @if(isset($article['desc']))
                        <div class="mb-4">
                            <h4>Полный текст</h4>
                            <p>{{ $article['desc'] }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection