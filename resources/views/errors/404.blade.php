@extends('layouts.app')

@section('title', 'Страница не найдена')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card text-center shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h3 class="mb-0">Страница не найдена</h3>
                </div>
                <div class="card-body">
                    
                    <h1 class="display-1 fw-bold text-warning">404</h1>
                    <h4 class="mb-3">Запрашиваемая страница не существует</h4>
                    <p class="text-muted mb-4">
                        Возможно, страница была удалена или вы перешли по неверной ссылке.
                    </p>
                    <a href="{{ route('home') }}" class="btn btn-primary">
                        Вернуться на главную
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection