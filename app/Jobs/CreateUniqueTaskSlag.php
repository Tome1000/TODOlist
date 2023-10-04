<?php

namespace App\Jobs;


use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Queue\SerializesModels;
use App\Models\Task;
use Illuminate\Support\Str;

class CreateUniqueTaskSlag
{
    use Dispatchable, SerializesModels;


    protected $task;
    /**
     * Create a new job instance.
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {


        $slug = $this->getCurrentTaskSlug();
        $relatedTasks = $this->getRelatedTasks($slug);

        $relatedTaskExist = $relatedTasks->contains(
            Task::where('slug', $slug)->first()
        );

        if ($relatedTaskExist) {
            $slug = "$slug-{$relatedTasks->count()}";
           
        }
       
        $this -> task->slug = $slug;
    }

    protected function getCurrentTaskSlug()
    {
        return Str::slug($this->task->title);
    }

    protected function getRelatedTasks(string $slug)
    {
        return Task::where('slug', 'LIKE', "$slug%")
            ->where('id', '<>', $this->task->id)
            ->get();    
    }
}
