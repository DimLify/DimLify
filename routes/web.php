<?php

use App\Models\Task ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;


Route::get('/', function () {
    $tasks = Task::orderBy('create_at', 'asc')->get();

    return view('tasks', [
        'tasks' => $tasks
    ]);
});

Route::post('/task',function(Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255' ,
    ]);
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    $task = new Task;
    $task->name = $request->name;
    $task->save();

    return redirect('/');
});
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// // Add A New Task
// Route::post('/task' , function (Request $request) {
//     //
// });
// Delete An Existing Task
Route::delete('/task/{id}' , function ($id) {
    Task::find0rFail($id)->delete();

    return redirect('/');
});


