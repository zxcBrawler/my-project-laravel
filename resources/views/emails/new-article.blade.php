<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новая статья</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }
        .header {
            background-color: #0d6efd;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            padding: 20px;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 10px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-radius: 0 0 5px 5px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #0d6efd;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }
        .info {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Новая статья добавлена</h2>
        </div>
        
        <div class="content">
            <h3>Здравствуйте, модератор!</h3>
            <p>На сайте была добавлена новая статья:</p>
            
            <div class="info">
                <strong>Заголовок:</strong> {{ $article->title }}<br>
                <strong>Категория:</strong> {{ $article->category ?? 'Без категории' }}<br>
                <strong>Дата создания:</strong> {{ $article->created_at->format('d.m.Y H:i') }}<br>
                <strong>Статус:</strong> {{ $article->is_published ? 'Опубликовано' : 'Черновик' }}
            </div>
            
            <p><strong>Краткое описание:</strong></p>
            <p>{{ Str::limit($article->short_description, 200) }}</p>
            
            <a href="{{ route('admin.articles.show', $article) }}" class="btn btn-primary text-white">
                Просмотреть статью
            </a>
            
            <p style="margin-top: 20px;">
                <a href="{{ route('admin.articles.edit', $article) }}">Редактировать статью</a>
            </p>
        </div>
        
        <div class="footer">
            <p>Это автоматическое сообщение. Пожалуйста, не отвечайте на него.</p>
            <p>© {{ date('Y') }} {{ config('app.name') }}</p>
        </div>
    </div>
</body>
</html>