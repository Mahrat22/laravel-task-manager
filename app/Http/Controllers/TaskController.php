<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    // List tasks with search + filter, paginated
    public function index(Request $request)
    {
        $search = $request->query('search');
        $filter = $request->query('filter'); // under_15 | above_15 | all

        $q = DB::table('tasks');

        if (!empty($search)) {
            $q->where('title', 'like', "%{$search}%");
        }

        if ($filter === 'under_15') {
            $q->where('order', '<', 15);
        } elseif ($filter === 'above_15') {
            $q->where('order', '>=', 15);
        }

        $tasks = $q->orderBy('order')->paginate(9)->withQueryString();

        return view('tasks', compact('tasks'));
    }

    // Create form
    public function create()
    {
        return view('tasks_create');
    }

    // Store new task
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'required|integer|unique:tasks,order',
        ]);

        DB::table('tasks')->insert([
            'title' => $request->title,
            'description' => $request->description,
            'order' => $request->order,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('tasks.index')->with('ok', 'Task created.');
    }

    // Details page
    public function show($id)
    {
        $task = DB::table('tasks')->where('id', $id)->first();
        abort_if(!$task, 404);
        return view('tasks_show', compact('task'));
    }

    // Edit form
    public function edit($id)
    {
        $task = DB::table('tasks')->where('id', $id)->first();
        abort_if(!$task, 404);
        return view('tasks_edit', compact('task'));
    }

    // Update task
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'required|integer|unique:tasks,order,' . $id,
        ]);

        DB::table('tasks')->where('id', $id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'order' => $request->order,
            'updated_at' => now(),
        ]);

        return redirect()->route('tasks.index')->with('ok', 'Task updated.');
    }

    // Delete task
    public function destroy($id)
    {
        DB::table('tasks')->where('id', $id)->delete();
        return redirect()->route('tasks.index')->with('ok', 'Task deleted.');
    }

    // Toggle status (pending/done)
    public function toggle($id)
    {
        $task = DB::table('tasks')->where('id', $id)->first();
        abort_if(!$task, 404);

        $newStatus = ($task->status === 'done') ? 'pending' : 'done';

        DB::table('tasks')->where('id', $id)->update([
            'status' => $newStatus,
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('ok', 'Status updated.');
    }
}
