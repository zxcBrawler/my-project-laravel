<?php

namespace App\Jobs;

use App\Models\Article;
use App\Mail\NewArticleMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class VeryLongJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $article;

    /**
     * Create a new job instance.
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $moderators = User::whereHas('role', function ($query) {
                $query->where('slug', 'moderator');
            })->get();
            
            if ($moderators->isNotEmpty()) {
                foreach ($moderators as $moderator) {
                    Mail::to($moderator->email)->send(new NewArticleMail($this->article));
                }
            } else {
                Mail::to(config('mail.from.address'))->send(new NewArticleMail($this->article));
            }
            
            \Log::info('Письмо отправлено через очередь', [
                'article_id' => $this->article->id,
                'article_title' => $this->article->title
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Ошибка отправки письма через очередь: ' . $e->getMessage());
            throw $e;
        }
    }
}