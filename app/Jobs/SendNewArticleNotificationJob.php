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

class SendNewArticleNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $article;
    protected $moderatorEmail;

    /**
     * Create a new job instance.
     */
    public function __construct($article, $moderatorEmail)
    {
        $this->article = $article;
        $this->moderatorEmail = $moderatorEmail;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->moderatorEmail)->send(new NewArticleMail($this->article));
    }
}
