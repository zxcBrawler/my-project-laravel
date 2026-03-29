@extends('layouts.app')

@section('title', 'Ошибка сервера')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card text-center shadow-sm">
                <div class="card-header bg-danger text-white">
                    <h3 class="mb-0">Ошибка сервера</h3>
                </div>
                <div class="card-body">
                    <h1 class="display-1 fw-bold text-danger">500</h1>
                    <h4 class="mb-3">Что-то пошло не так</h4>
                    <p class="text-muted mb-4">
                        На сервере произошла ошибка. Пожалуйста, попробуйте позже.
                        <br>Если ошибка повторяется, свяжитесь с администратором.
                    </p>
                    <a href="{{ route('home') }}" class="btn btn-primary">
                        <i class="bi bi-house"></i> Вернуться на главную
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection