@extends('layouts.app')

@section('title', 'Детали лога')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-4">
                <a href="{{ route('admin.logs.index') }}" class="btn btn-secondary">
                    Назад к логам
                </a>
            </div>
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Детали действия</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">ID лога:</div>
                        <div class="col-md-8">{{ $log->id }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Пользователь:</div>
                        <div class="col-md-8">
                            @if($log->user)
                                {{ $log->user->name }} ({{ $log->user->email }})
                                <br>
                                <small class="text-muted">ID: {{ $log->user->id }}</small>
                            @else
                                Система
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Действие:</div>
                        <div class="col-md-8">
                            @if($log->action == 'created')
                                <span class="badge bg-success">Создание</span>
                            @elseif($log->action == 'updated')
                                <span class="badge bg-warning text-dark">Обновление</span>
                            @elseif($log->action == 'deleted')
                                <span class="badge bg-danger">Удаление</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Объект:</div>
                        <div class="col-md-8">{{ class_basename($log->model_type) }} (ID: {{ $log->model_id }})</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Описание:</div>
                        <div class="col-md-8">{{ $log->description }}</div>
                    </div>
                    @if($log->old_values)
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Старые значения:</div>
                            <div class="col-md-8">
                                <pre class="bg-light p-2 rounded">{{ json_encode($log->old_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                            </div>
                        </div>
                    @endif
                    @if($log->new_values)
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Новые значения:</div>
                            <div class="col-md-8">
                                <pre class="bg-light p-2 rounded">{{ json_encode($log->new_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                            </div>
                        </div>
                    @endif
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">IP адрес:</div>
                        <div class="col-md-8">{{ $log->ip_address ?? '-' }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">User Agent:</div>
                        <div class="col-md-8"><small>{{ $log->user_agent ?? '-' }}</small></div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Дата и время:</div>
                        <div class="col-md-8">{{ $log->created_at->format('d.m.Y H:i:s') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection