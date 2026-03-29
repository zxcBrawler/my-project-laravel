@extends('layouts.app')

@section('title', 'Доступ запрещен')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h3 class="mb-0">Доступ запрещен</h3>
                </div>
                <div class="card-body">
                    <h1 class="display-1 fw-bold text-danger">403</h1>
                    <h4 class="mb-3">{{ 'У вас недостаточно прав для выполнения этого действия' }}</h4>
                    <p class="text-muted mb-4">
                        К сожалению, у вас нет необходимых прав доступа к этому ресурсу.
                        @if(!Auth::check())
                            Пожалуйста, <a href="{{ route('login') }}">войдите в систему</a>.
                        @endif
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