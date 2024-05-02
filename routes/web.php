<?php
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Task;


Route::get('/',function(){
	return redirect(route('tasks.index'));
});
Route::view('/tasks/create','create')->name("tasks.create");

Route::get('/tasks/{task}',function(Task $task) {
	
	return view('show',['task'=>$task]);
})->name('tasks.show');

Route::get('/tasks/{task}/edit',function(Task $task) {
	
	return view('edit',['task'=>$task]);
})->name('tasks.edit');

Route::get('/tasks', function () {
    return view('index',[
			//'tasks'=>Task::latest()->where('completed',true)->get()
			'tasks'=>Task::latest()->paginate()
		]);
})->name('tasks.index');
Route::get('/xxx', function(){
return 'Hello';
})->name('hello');
Route::get('/hallo', function(){
	return redirect()->route('hello');
});
Route::get('/greet/{name}', function ($name){
	return 'Hello '. $name . '!';
});
Route::fallback(function(){
	return 'Still got somewhere';
});
Route::post('/tasks', function(TaskRequest $request){
	//dd($request->all());
	/*$data = $request->validate([
		'title'=>'required|max:255',
		'description'=>'required',
		'long_description'=>'required'
	]);*/
	/*$data = $request->validated();
	$task = new Task;
	$task->title = $data['title'];
	$task->description = $data['description'];
	$task->long_description = $data['long_description'];
	$task->save();*/
	$task = Task::create( $request->validated());
	return redirect()->route('tasks.show',['task'=>$task->id])->with('success','The Task created successfully!');
})->name('tasks.store');


Route::put('/tasks/{task}', function(Task $task, TaskRequest $request){
	//dd($request->all());
	/*$data = $request->validate([
		'title'=>'required|max:255',
		'description'=>'required',
		'long_description'=>'required'
	]);*/
	/*$data = $request->validated();
	$task->title = $data['title'];
	$task->description = $data['description'];
	$task->long_description = $data['long_description'];
	$task->save();*/
	$task->update( $request->validated());
	return redirect()->route('tasks.show',['task'=>$task->id])->with('success','The Task updated successfully!');
})->name('tasks.update');
Route::delete('/tasks/{task}', function(Task $task){
	$task->delete();
	return redirect()->route('tasks.index')->with('success','The Task deleted successfully!');
})->name('tasks.destroy');
Route::put('/tasks/{task}/toggle-complete', function(Task $task){
	$task->toggleComplete();
	return redirect()->back()->with('success', 'Task updated successfully!');
})->name('tasks.toggle-complete');
