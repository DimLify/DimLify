<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

 /**
    * Show Task Dashboard
    */

    Route::get('/', function () {
        $tasks = app\Models\Task::orderBy('created_at', 'asc')->get();
        return view('tasks', [
            'tasks' => $tasks
        ]);
    });

    /**
     * Add New Task
     */
    Route::post('/task', function (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $task = new  app\Models\Task;
        $task->name = $request->name;
        $task->save();
        return redirect('/');
    });

    /**
     * Delete Task
     */
    Route::delete('/task/{task}', function ( app\Models\Task $task) {
        $task->delete();

        return redirect('/');
    });