<?php

namespace App\Observers;

use App\Jobs\CreateUniqueTaskSlag;
use App\Models\Task;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskCreated;


class TaskObserver
{
    public function creating(Task $task)
    {
        CreateUniqueTaskSlag::dispatch($task);

        Mail::to('admin@laravel-od-podstaw.test')
            ->send(
                new TaskCreated($task)
            );
    }

    public function updating(Task $task)
    {

        CreateUniqueTaskSlag::dispatch($task);
    }
}
