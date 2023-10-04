<?php

namespace App\Http\Controllers;

use App\Models\Task;

class SiteController extends Controller
{
    public function index(){

      
        return redirect(
           route('tasks.index', ['type' => Task::getStatus('Active')]),
          301

       );
    }



}
