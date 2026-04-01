@extends('layouts.app')

@section('title', 'Логи действий')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Логи действий</h1>
        <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">
            Назад к статьям
        </a>
    </div>
    <div class="mb-3">
        <div class="card-body">
            <div class="btn-group flex-wrap">
                <a href="{{ route('admin.logs.index', array_merge(request()->except(['quick_filter', 'page']), ['quick_filter' => null])) }}" 
                   class="btn btn-outline-primary {{ !request('quick_filter') ? 'active' : '' }}">
                    Все
                </a>
                <a href="{{ route('admin.logs.index', array_merge(request()->except(['quick_filter', 'page']), ['quick_filter' => 'today'])) }}" 
                   class="btn btn-outline-primary {{ request('quick_filter') == 'today' ? 'active' : '' }}">
                    Сегодня
                </a>
                <a href="{{ route('admin.logs.index', array_merge(request()->except(['quick_filter', 'page']), ['quick_filter' => 'yesterday'])) }}" 
                   class="btn btn-outline-primary {{ request('quick_filter') == 'yesterday' ? 'active' : '' }}">
                    Вчера
                </a>
                <a href="{{ route('admin.logs.index', array_merge(request()->except(['quick_filter', 'page']), ['quick_filter' => 'week'])) }}" 
                   class="btn btn-outline-primary {{ request('quick_filter') == 'week' ? 'active' : '' }}">
                    Последние 7 дней
                </a>
                <a href="{{ route('admin.logs.index', array_merge(request()->except(['quick_filter', 'page']), ['quick_filter' => 'month'])) }}" 
                   class="btn btn-outline-primary {{ request('quick_filter') == 'month' ? 'active' : '' }}">
                    Последний месяц
                </a>
            </div>
            @if(request('quick_filter'))
                <div class="mt-2 text-muted small">
                    <i class="bi bi-info-circle"></i> 
                    @if(request('quick_filter') == 'today') Показаны логи за сегодня
                    @elseif(request('quick_filter') == 'yesterday') Показаны логи за вчера
                    @elseif(request('quick_filter') == 'week') Показаны логи за последние 7 дней
                    @elseif(request('quick_filter') == 'month') Показаны логи за последний месяц
                    @endif
                </div>
            @endif
        </div>
    </div>
    <div class="mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.logs.index') }}" class="row g-3">
                @if(request('quick_filter'))
                    <input type="hidden" name="quick_filter" value="{{ request('quick_filter') }}">
                @endif
                
                <div class="col-md-2">
                    <input type="text" name="user_id" class="form-control" 
                           placeholder="ID пользователя" value="{{ request('user_id') }}">
                </div>
                <div class="col-md-2">
                    <select name="action" class="form-select">
                        <option value="">Все действия</option>
                        <option value="created" {{ request('action') == 'created' ? 'selected' : '' }}>Создание</option>
                        <option value="updated" {{ request('action') == 'updated' ? 'selected' : '' }}>Обновление</option>
                        <option value="deleted" {{ request('action') == 'deleted' ? 'selected' : '' }}>Удаление</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="model_type" class="form-select">
                        <option value="">Все модели</option>
                        <option value="App\Models\Article" {{ request('model_type') == 'App\Models\Article' ? 'selected' : '' }}>Статьи</option>
                        <option value="App\Models\Comment" {{ request('model_type') == 'App\Models\Comment' ? 'selected' : '' }}>Комментарии</option>
                        <option value="App\Models\User" {{ request('model_type') == 'App\Models\User' ? 'selected' : '' }}>Пользователи</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="date" name="date_from" class="form-control" 
                           placeholder="Дата от" value="{{ request('date_from') }}">
                </div>
                <div class="col-md-2">
                    <input type="date" name="date_to" class="form-control" 
                           placeholder="Дата до" value="{{ request('date_to') }}">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
            
            @if(request('user_id') || request('action') || request('model_type') || request('date_from') || request('date_to'))
                <div class="mt-3">
                    <a href="{{ route('admin.logs.index', request()->has('quick_filter') ? ['quick_filter' => request('quick_filter')] : []) }}" 
                       class="btn btn-sm btn-secondary">
                        <i class="bi bi-x-circle"></i> Сбросить фильтры
                    </a>
                </div>
            @endif
        </div>
    </div>
    @if($logs->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Пользователь</th>
                        <th>Действие</th>
                        <th>Объект</th>
                        <th>Описание</th>
                        <th>IP адрес</th>
                        <th>Дата</th>
                        <th>Детали</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                        <tr>
                            <td>{{ $log->id }}</td>
                            <td>
                                @if($log->user)
                                    {{ $log->user->name }}
                                    <br>
                                    <small class="text-muted">ID: {{ $log->user->id }}</small>
                                @else
                                    <span class="text-muted">Система</span>
                                @endif
                            </td>
                            <td>
                                @if($log->action == 'created')
                                    <span class="badge bg-success">Создание</span>
                                @elseif($log->action == 'updated')
                                    <span class="badge bg-warning text-dark">Обновление</span>
                                @elseif($log->action == 'deleted')
                                    <span class="badge bg-danger">Удаление</span>
                                @else
                                    <span class="badge bg-secondary">{{ $log->action }}</span>
                                @endif
                            </td>
                            <td>
                                {{ class_basename($log->model_type) }}
                                @if($log->model_id)
                                    <br>
                                    <small class="text-muted">ID: {{ $log->model_id }}</small>
                                @endif
                            </td>
                            <td>{{ Str::limit($log->description, 80) }}</td>
                            <td>
                                <small>{{ $log->ip_address ?? '-' }}</small>
                            </td>
                            <td>
                                <small>{{ $log->created_at->format('d.m.Y H:i:s') }}</small>
                            </td>
                            <td>
                                <a href="{{ route('admin.logs.show', $log) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i> Детали
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="text-center mt-4">
            {{ $logs->links() }}
        </div>
    @else
        <div class="alert alert-info text-center">
            Логов не найдено
        </div>
    @endif
</div>

@endsection