@extends('layouts.app')

@section('title', 'Контакты')

@section('content')
<div class="container">
    <h1 class="text-center mb-5">Наши контакты</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Контактная информация</h3>
                </div>
                <div class="card-body">
                    @if(isset($contacts) && count($contacts) > 0)
                        @foreach($contacts as $contact)
                            <div class="contact-item mb-4 pb-3 border-bottom">
                                <div class="d-flex align-items-start">
                                
                                    <div class="contact-details flex-grow-1">
                                        <h4 class="mb-2">{{ $contact['title'] }}</h4>
                                        
                                        @if(isset($contact['is_link']) && $contact['is_link'])
                                            <p class="mb-2">
                                                <a href="{{ $contact['link_prefix'] ?? '' }}{{ $contact['value'] }}" 
                                                   class="text-decoration-none"
                                                   target="{{ isset($contact['link_prefix']) && strpos($contact['link_prefix'], 'http') === 0 ? '_blank' : '_self' }}">
                                                    <strong>{{ $contact['value'] }}</strong>
                                                </a>
                                            </p>
                                        @else
                                            <p class="mb-2">
                                                <strong>{!! $contact['value'] !!}</strong>
                                            </p>
                                        @endif
                                        
                                        @if(isset($contact['description']))
                                            <small class="text-muted">{{ $contact['description'] }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-info">
                            Информация о контактах временно недоступна.
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            @if(isset($social) && count($social) > 0)
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-success text-white">
                        <h3 class="mb-0">Мы в соцсетях</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($social as $item)
                                <div class="col-md-4 mb-3">
                                    <a href="{{ $item['url'] }}" target="_blank" class="text-decoration-none">
                                        <div class="social-card text-center p-3 border rounded hover-shadow">
                                            
                                            <h5 class="mt-2 mb-0">{{ $item['name'] }}</h5>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h3 class="mb-0">Написать нам</h3>
                </div>
                <div class="card-body">
                    <form action="#" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Ваше имя</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Сообщение</label>
                            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Отправить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    .contact-item {
        transition: all 0.3s ease;
    }
    .contact-item:hover {
        background-color: #f8f9fa;
        padding-left: 10px;
    }
    .social-card {
        transition: all 0.3s ease;
        background-color: #f8f9fa;
        border-radius: 10px;
    }
    .social-card:hover {
        background-color: #e9ecef;
    }
</style>
@endsection