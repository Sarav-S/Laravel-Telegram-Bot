<?php

namespace App\Http\Controllers;

use App\Helpers\Date;
use App\Http\Requests\Reminder\StoreRequest;
use App\Reminder;
use App\Scheduler\FrequencyBuilder;
use Cron\CronExpression;

class ReminderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = new Date();
        $reminders = Reminder::latest()->paginate();

        return view('reminders.index', compact('reminders', 'date'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Reminder\StoreRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $params = (object) $request->all();

        $expression = $this->buildCronExpression($params);

        if (CronExpression::isValidExpression($expression)) {
            $this->createReminder($params, $expression);
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reminder $reminder)
    {
        $reminder->delete();

        return redirect(route('reminders.index'));
    }

    protected function createReminder($params, $expression)
    {
        Reminder::create([
            'body'       => $params->body ?: 'No body',
            'frequency'  => $params->frequency,
            'day'        => $params->day ?: null,
            'date'       => $params->date ?: null,
            'time'       => $params->time,
            'expression' => $expression,
            'run_once'   => isset($params->run_once),
        ]);
    }

    protected function buildCronExpression($params)
    {
        list($hour, $minute) = explode(':', $params->time);

        $builder = new FrequencyBuilder();
        $builder->frequency($params->frequency);
        $builder->day($params->day);
        $builder->date($params->date);
        $builder->time((int) $hour, (int) $minute);

        return $builder->expression();
    }
}
