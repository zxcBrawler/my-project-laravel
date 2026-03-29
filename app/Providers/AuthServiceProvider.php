<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\User;
use App\Policies\ArticlePolicy;
use App\Exceptions\ForbiddenException;
use App\Exceptions\UnauthorizedException;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Article::class => ArticlePolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            if ($user && $user->isModerator()) {
                return true;
            }
        });

        Gate::define('access-admin', function (User $user) {
            return $user->isModerator();
        });

        Gate::define('manage-comments', function (User $user) {
            if (!$user->isModerator()) {
                throw new ForbiddenException('Только модераторы могут управлять комментариями');
            }
            return true;
        });

        Gate::define('publish-articles', function (User $user) {
            if (!$user->isModerator()) {
                throw new ForbiddenException('Только модераторы могут публиковать статьи');
            }
            return true;
        });

        Gate::define('delete-article', function (User $user, Article $article) {
            if (!$user->isModerator()) {
                throw new ForbiddenException('У вас нет прав на удаление этой статьи');
            }
            return true;
        });

        Gate::define('edit-article', function (User $user, Article $article) {
            if (!$user->isModerator()) {
                throw new ForbiddenException('У вас нет прав на редактирование этой статьи');
            }
            return true;
        });
    }
}