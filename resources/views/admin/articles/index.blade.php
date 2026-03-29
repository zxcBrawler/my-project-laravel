@extends('layouts.app')

@section('title', 'Управление новостями')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Управление новостями</h1>
        @can('create', App\Models\Article::class)
            <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">
                + Создать новость
            </a>
        @endcan
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.articles.index') }}" class="row g-3">
                <div class="col-md-8">
                    <input type="text" 
                        name="search" 
                        class="form-control" 
                        placeholder="Поиск по заголовку, описанию или категории..."
                        value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Найти
                    </button>
                </div>
                @if(request('search'))
                    <div class="col-12">
                        <a href="{{ route('admin.articles.index') }}" class="text-decoration-none">
                            <i class="bi bi-x-circle"></i> Сбросить поиск
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>    
    @if($articles->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>
                            <a href="{{ route('admin.articles.index', ['sort' => 'id', 'direction' => ($sortField == 'id' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}" 
                               class="text-decoration-none text-dark">
                                ID
                                @if($sortField == 'id')
                                    @if($sortDirection == 'asc')
                                        <i class="bi bi-arrow-up"></i>
                                    @else
                                        <i class="bi bi-arrow-down"></i>
                                    @endif
                                @else
                                    <i class="bi bi-arrow-down-up text-muted"></i>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('admin.articles.index', ['sort' => 'title', 'direction' => ($sortField == 'title' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}" 
                               class="text-decoration-none text-dark">
                                Заголовок
                                @if($sortField == 'title')
                                    @if($sortDirection == 'asc')
                                        <i class="bi bi-arrow-up"></i>
                                    @else
                                        <i class="bi bi-arrow-down"></i>
                                    @endif
                                @else
                                    <i class="bi bi-arrow-down-up text-muted"></i>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('admin.articles.index', ['sort' => 'category', 'direction' => ($sortField == 'category' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}" 
                               class="text-decoration-none text-dark">
                                Категория
                                @if($sortField == 'category')
                                    @if($sortDirection == 'asc')
                                        <i class="bi bi-arrow-up"></i>
                                    @else
                                        <i class="bi bi-arrow-down"></i>
                                    @endif
                                @else
                                    <i class="bi bi-arrow-down-up text-muted"></i>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('admin.articles.index', ['sort' => 'views', 'direction' => ($sortField == 'views' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}" 
                               class="text-decoration-none text-dark">
                                Просмотры
                                @if($sortField == 'views')
                                    @if($sortDirection == 'asc')
                                        <i class="bi bi-arrow-up"></i>
                                    @else
                                        <i class="bi bi-arrow-down"></i>
                                    @endif
                                @else
                                    <i class="bi bi-arrow-down-up text-muted"></i>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('admin.articles.index', ['sort' => 'is_published', 'direction' => ($sortField == 'is_published' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}" 
                               class="text-decoration-none text-dark">
                                Статус
                                @if($sortField == 'is_published')
                                    @if($sortDirection == 'asc')
                                        <i class="bi bi-arrow-up"></i>
                                    @else
                                        <i class="bi bi-arrow-down"></i>
                                    @endif
                                @else
                                    <i class="bi bi-arrow-down-up text-muted"></i>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('admin.articles.index', ['sort' => 'published_date', 'direction' => ($sortField == 'published_date' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}" 
                               class="text-decoration-none text-dark">
                                Дата
                                @if($sortField == 'published_date')
                                    @if($sortDirection == 'asc')
                                        <i class="bi bi-arrow-up"></i>
                                    @else
                                        <i class="bi bi-arrow-down"></i>
                                    @endif
                                @else
                                    <i class="bi bi-arrow-down-up text-muted"></i>
                                @endif
                            </a>
                        </th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $article)
                        <tr>
                            <td>{{ $article->id }}</td>
                            <td>{{ Str::limit($article->title, 50) }}</td>
                            <td>{{ $article->category ?? '-' }}</td>
                            <td>{{ $article->views }}</td>
                            <td>
                                @if($article->is_published)
                                    <span class="badge bg-success">Опубликовано</span>
                                @else
                                    <span class="badge bg-secondary">Черновик</span>
                                @endif
                            </td>
                            <td>{{ $article->formatted_date }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.articles.show', $article) }}" 
                                    class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.articles.edit', $article) }}" 
                                    class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.articles.destroy', $article) }}" 
                                        method="POST" 
                                        class="d-inline"
                                        onsubmit="return confirm('Удалить новость?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        
        <div class="text-center mt-4">
            {{ $articles->links() }}
        </div>
    @else
        <div class="alert alert-info">
            Новостей пока нет. Создайте первую новость!
        </div>
    @endif
</div>
@endsection