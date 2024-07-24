<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $tasks = Task::with('category')->paginate();

        $pending = Task::Where('status', 'pending')->count();

        $completed = Task::Where('status', 'completed')->count();

        return view('task.index', compact('tasks', 'pending', 'completed'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('task.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        Task::create($request->all());

        return redirect()->route('dashboard.task.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $categories = Category::all();

        return view('task.edit', compact('task','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);

        $task->update($request->all());

        return redirect()->route('dashboard.task.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        Task::destroy($task->id);

        return redirect()->route('dashboard.task.index');
    }

    public function all(Request $request) {

        $tasks = Task::with('category')->get();


        return Response::json($tasks);
    }

    public function delete(Request $request, $id) {

        $task = Task::where('id', $id)->first();

        if($task) {
            $task->delete();
        }
        return 'Task Deleted Successfully';

    }

    public function trash() {

        $tasks = Task::onlyTrashed()->get();

        return view('task.trash', compact('tasks'));
    }

    public function restore($id) {

        $tasks = Task::onlyTrashed()->where('id', $id)->restore();

        return redirect()->route('dashboard.task.index');
    }

    public function filter(Request $request) {

        $request->validate([
            'title' => ['required', 'string'],
            'status' => ['nullable','in:pending,completed'],
        ]);

        
        if($request->status) {

            $tasks = Task::where('title', 'LIKE', "%$request->title%")
            ->where('status', $request->status)
            ->with('category')
            ->get();
            
        } else {
            $tasks = Task::where('user_id', Auth::id())
            ->where('title', 'LIKE', "%$request->title%")
            ->with('category')
            ->get();
        }

        return $tasks;
    }


}

