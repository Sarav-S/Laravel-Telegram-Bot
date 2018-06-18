<?php

namespace App\Scheduler;

use Carbon\Carbon;
use Cron\CronExpression;

abstract class Event
{
    use Frequencies;

    /**
     * The cron expression for this event.
     *
     * @var string
     */
    public $expression = '* * * * *';

    /**
     * Handle the event.
     *
     * @return void
     */
    abstract public function handle();

    /**
     * Check if the event is due to run.
     *
     * @param Carbon $date
     *
     * @return bool
     */
    public function isDueToRun(Carbon $date)
    {
        return CronExpression::factory($this->expression)->isDue($date);
    }
}
