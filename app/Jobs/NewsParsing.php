<?php declare(strict_types=1);

namespace App\Jobs;

use App\Contracts\Parser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NewsParsing implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public \stdClass $link;

    /**
     * Create a new job instance.
     *
     * @param \stdClass $link
     */
    public function __construct(\stdClass $link)
    {
        $this->link = $link;
    }

    /**
     * Execute the job.
     *
     * @param Parser $parser
     * @return void
     */
    public function handle(Parser $parser):void
    {
        $parser->saveNewsInDatabase($this->link);
    }
}
