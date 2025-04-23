<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $tasks = Auth::user()->tasks()->orderBy('created_at', 'desc')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'due_date' => 'nullable|date',
        ]);
        
        $task = Auth::user()->tasks()->create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'due_date' => $validated['due_date'],
        ]);
        
        return redirect()->route('tasks.index')
            ->with('success', '任務已成功建立！');
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);
        
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'due_date' => 'nullable|date',
            'is_completed' => 'nullable|boolean',
        ]);
        
        $task->update($validated);
        
        return redirect()->route('tasks.index')
            ->with('success', '任務已成功更新！');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
        
        return redirect()->route('tasks.index')
            ->with('success', '任務已成功刪除！');
    }
    
    public function toggleComplete(Task $task)
    {
        $this->authorize('update', $task);
        $task->update([
            'is_completed' => !$task->is_completed
        ]);
        
        return redirect()->back()->with('success', '任務狀態已更新！');
    }
}
