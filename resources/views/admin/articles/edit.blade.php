@extends('layouts.app')

@section('title', 'Редактировать новость')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <div class="card-header">
                    <h3>Редактировать новость: {{ $article->title }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.articles.update', $article) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Заголовок *</label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title', $article->title) }}"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="category" class="form-label">Категория</label>
                            <select class="form-control @error('category') is-invalid @enderror" 
                                    id="category" 
                                    name="category">
                                <option value="">Выберите категорию</option>
                                <option value="наука" {{ old('category', $article->category) == 'наука' ? 'selected' : '' }}>Наука</option>
                                <option value="технологии" {{ old('category', $article->category) == 'технологии' ? 'selected' : '' }}>Технологии</option>
                                <option value="спорт" {{ old('category', $article->category) == 'спорт' ? 'selected' : '' }}>Спорт</option>
                                <option value="культура" {{ old('category', $article->category) == 'культура' ? 'selected' : '' }}>Культура</option>
                                <option value="политика" {{ old('category', $article->category) == 'политика' ? 'selected' : '' }}>Политика</option>
                                <option value="экономика" {{ old('category', $article->category) == 'экономика' ? 'selected' : '' }}>Экономика</option>
                                <option value="интересное" {{ old('category', $article->category) == 'интересное' ? 'selected' : '' }}>Интересное</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="short_description" class="form-label">Краткое описание *</label>
                            <textarea class="form-control @error('short_description') is-invalid @enderror" 
                                      id="short_description" 
                                      name="short_description" 
                                      rows="3"
                                      required>{{ old('short_description', $article->short_description) }}</textarea>
                            @error('short_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="content" class="form-label">Полное содержание *</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" 
                                      id="content" 
                                      name="content" 
                                      rows="10"
                                      required>{{ old('content', $article->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="preview_image" class="form-label">Превью изображение</label>
                            <input type="text" 
                                   class="form-control @error('preview_image') is-invalid @enderror" 
                                   id="preview_image" 
                                   name="preview_image" 
                                   value="{{ old('preview_image', $article->preview_image) }}"
                                   placeholder="/preview.jpg">
                            <small class="text-muted">Путь к изображению в папке public</small>
                            @error('preview_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="full_image" class="form-label">Полное изображение</label>
                            <input type="text" 
                                   class="form-control @error('full_image') is-invalid @enderror" 
                                   id="full_image" 
                                   name="full_image" 
                                   value="{{ old('full_image', $article->full_image) }}"
                                   placeholder="/full.jpeg">
                            <small class="text-muted">Путь к изображению в папке public</small>
                            @error('full_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="published_date" class="form-label">Дата публикации</label>
                            <input type="date" 
                                   class="form-control @error('published_date') is-invalid @enderror" 
                                   id="published_date" 
                                   name="published_date" 
                                   value="{{ old('published_date', $article->published_date ? $article->published_date->format('Y-m-d') : date('Y-m-d')) }}">
                            @error('published_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3 form-check">
                            <input type="checkbox" 
                                class="form-check-input" 
                                id="is_published" 
                                name="is_published"
                                value="1"
                                {{ old('is_published', $article->is_published) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_published">
                                Опубликовано
                            </label>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">
                                Отмена
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Сохранить изменения
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection