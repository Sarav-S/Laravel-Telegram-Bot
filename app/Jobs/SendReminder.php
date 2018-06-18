<?php

namespace App\Jobs;

use App\Reminder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $reminder;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Reminder $reminder)
    {
        $this->reminder = $reminder;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = new \GuzzleHttp\Client();

        $client->request('GET', $this->buildRequestUrl());

        $this->deleteIfRunOnceIsEnabled();
    }

    private function buildRequestUrl()
    {
        return 'https://api.telegram.org/bot'.config('telegram.secret').'/sendMessage?chat_id='.config('telegram.chat_id')."&text={$this->reminder->body}";
    }

    private function deleteIfRunOnceIsEnabled()
    {
        if ($this->reminder->run_once) {
            $this->reminder->delete();
        }
    }
}
