@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Регистрация</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('signin.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Имя</label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}"
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Пароль</label>
                            <div class="position-relative">
                                <input type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password" 
                                       required>
                                <i class="bi bi-eye-slash password-toggle" 
                                   id="togglePassword"
                                   style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="text-muted">Минимум 6 символов</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Подтверждение пароля</label>
                            <div class="position-relative">
                                <input type="password" 
                                       class="form-control" 
                                       id="password_confirmation" 
                                       name="password_confirmation" 
                                       required>
                                <i class="bi bi-eye-slash password-toggle" 
                                   id="toggleConfirmPassword"
                                   style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">Зарегистрироваться</button>
                    </form>
                    
                    <div class="mt-3 text-center">
                        <small class="text-muted">
                            Уже есть аккаунт? <a href="#">Войти</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection