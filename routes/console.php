<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Drain the database queue on shared hosting (no persistent worker available).
// A single `* * * * * php artisan schedule:run` cron drives this every minute.
// --stop-when-empty exits as soon as the queue is empty; --max-time caps a run.
Schedule::command('queue:work --stop-when-empty --max-time=55 --tries=3')
    ->everyMinute()
    ->withoutOverlapping(5);
