<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $fillable = ['body', 'day', 'date', 'time', 'frequency', 'expression', 'run_once'];

    protected $dates = ['created_at', 'updated_at'];
}
