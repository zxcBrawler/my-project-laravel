@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title display-4">Добро пожаловать!</h1>
                    <p class="card-text lead mt-4">
                        Это главная страница нашего сайта. Здесь в будущем будут публиковаться новости и актуальная информация.
                    </p>
                    <hr>
                    <p class="text-muted">
                        Мы рады приветствовать вас на нашем сайте!
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection