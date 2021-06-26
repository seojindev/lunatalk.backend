<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use Illuminate\Queue\SerializesModels;
use App\Notifications\ServiceNotice;

class ServiceSlackNotice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Object
     */
    private Object $task;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Object $task)
    {
        $this->task = $task;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (env('APP_ENV') == 'local') {
            return;
        }

        Notification::route('slack', env('SLACK_WEBHOOK_URL'))->notify(new ServiceNotice((object) [
            'type' => $this->task->type,
            'message' => $this->task->message
        ]));
    }
}
