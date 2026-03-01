<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Article;
use Carbon\Carbon;

class PublishScheduledArticles extends Command
{
    protected $signature = 'publish:scheduled-articles';

    protected $description = 'Publish scheduled articles automatically';

    public function handle()
    {
        $count = Article::where('status', 'scheduled')
            ->whereNotNull('scheduled_at')
            ->where('scheduled_at', '<=', Carbon::now())
            ->update([
                'status' => 'published',
                'published_at' => Carbon::now(),
            ]);

        $this->info("Published {$count} scheduled articles.");
    }
}