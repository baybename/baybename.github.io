<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return 'Trang chủ';
});



//lập tuyến dự phòng chỉ trả về một đường dẫn khi truy cập vào trang khác
Route::get('/', function (){
  return redirect()->route('task.index');
});

// truyền biến task vào
Route::get('/tasks', function (){
    return view('index', [
        'tasks' => Task::latest()->paginate(10)
    ]);
})->name('task.index');

Route::view('/tasks/create','create')
->name('tasks.create');//phía trước là tên đường dẫn, phía sau là file truy cập
    
Route::get('tasks/{task}/edit', function (Task $task) {
  return view('edit', [
      'task' => $task
  ]);
})->name ('task.edit');

//tạo thêm đường dẫn
Route::get('tasks/{task}', function (Task $task) {
    return view('show', [
      'task' => $task
    ]);// nếu tìm được thì hiện nếu k thì lỗi 404
})->name ('task.show');

Route::post('/tasks', function (TaskRequest $request){
    $data = $request->validated();
    $task = Task::create($request->validated());

    return redirect()->route('task.show', ['task' => $task->id])
    ->with('success', 'Task created successfully');

})->name('tasks.store');



Route::put('/tasks/{task}', function (Task $task, TaskRequest $request){
  $data = $request->validated();
  $task->update($request->validated());

  return redirect()->route('task.show', ['task' => $task->id])
  ->with('success', 'Task updated successfully');

})->name('tasks.update');


Route::delete('/tasks/{task}', function ( Task $task ) {
    $task->delete();

    return redirect()->route('task.index')
    ->with('success', 'Task deleted successfully');
})->name('tasks.destroy');


Route::put('/tasks/{task}/toggle-complete', function(Task $task) {
  $task->toggleCompleted(); 

  return redirect()->back()->with('success', 'Task updated successfully');
})->name('task.toggle-complete');


// lập tuyến dự phòng khi users truy cập vào đường dẫn k tồn tại
Route::fallback(function (){
  return 'không có gì ở đây';
});


