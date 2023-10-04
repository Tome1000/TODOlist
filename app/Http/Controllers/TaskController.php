<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\Task\Request as TaskRequest;
use App\Models\Task;

use Illuminate\Support\Facades\App;

App::setLocale('pl');

class TaskController extends Controller
{
    const TASK_PER_PAGE = 5;

    public function __construct()
    {

        $this->middleware('auth');
    }

    public function index(string $type = null)
    {

        if(is_null($type)){

            return redirect()->route('tasks.index', ['type' => Task::getStatus('Active')]);
        }

 
        $user = $this->getAuthorizedUser();

        $data = [


            'active' => [
                'tasks' => $user->tasksByStatus('Active')->paginate(self::TASK_PER_PAGE),
                'isActive' => ($type == Task::getStatus('Active')),
                'oppositeStatus' => Task::getStatus('Completed'),
                'labels' => [
                    'mark'  => 'Oznacz jako zakończone',
                    'empty' => 'Wszystkie zadania są zakończone',
                    'nav'   => 'Aktywne'
                ]
            ],

            'completed' => [
                'tasks' => $user->tasksByStatus('Completed')->paginate(self::TASK_PER_PAGE),
                'isActive' => ($type == Task::getStatus('Completed')),
                'oppositeStatus' => Task::getStatus('Active'),
                'labels' => [
                    'mark'  => 'Oznacz jako aktywne',
                    'empty' => 'Tutaj pojawią się twoje zakończone zadania',
                    'nav'   => 'Zakończone'
                ]
            ]

        ];
        
        if (!array_key_exists($type, $data)) {
            return redirect()->route('tasks.index', ['type' => 'active']);
        }



        return view('tasks.index', [

            'tasks'      => $data[$type]['tasks'],
            'tasksData'  => $data[$type],
            'data'       => $data,


        ]);
    }
    public function add()
    {
       
        return view('tasks.add');
    }

    public function store(TaskRequest $request)
    {
        $task = $this->getAuthorizedUser()->tasks()->save(
            new Task($request->validated())
        );

        $task->tags()->sync(
            $request->input('tags', [])

        );



        return redirect(
            route(
                'tasks.show',
                ['task' => $task]

            )

        );
    }

    public function show(Task $task)
    {


        if (!$task->owner->isCurrentlyAuthorized()) {
            return abort(403);
        }

        return view('tasks.show', [
            'task' => $task

        ]);
    }

    public function edit(Task $task)
    {
        if (!$task->owner->isCurrentlyAuthorized()) {
            return abort(403);
        }



        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    public function update(TaskRequest $request, Task $task)
    {


        if (!$task->owner->isCurrentlyAuthorized()) {
            return abort(403);
        }

        $task->tags()->sync(
            $request->input('tags', [])

        );


        if ($task->update($request->validated())) {
            session()->flash('status', __('task.alerts.updated.success'));


            return redirect(
                route(
                    'tasks.show',
                    ['task' => $task]

                )

            );
        } else {
            session()->flash('status', __('task.alerts.updated.fail'));

            return redirect(
                route(
                    'tasks.show',
                    ['task' => $task]

                )

            );
        }
    }

    public function delete(Task $task)
    {


        if (!$task->owner->isCurrentlyAuthorized()) {
            return abort(403);
        }


        if ($task->delete()) {
            session()->flash('status', [
                'success' => true,
                'message' => 'Twoje zadanie zostało usunięte'


            ]);
            return redirect(
                route(
                    'tasks.index'


                )

            );
        } else {
            session()->flash('status', [
                'success' => false,
                'message' => 'Twoje zadanie nie zostało usunięte'


            ]);

            return redirect(
                route(
                    'tasks.index'


                )

            );
        }
    }
}
