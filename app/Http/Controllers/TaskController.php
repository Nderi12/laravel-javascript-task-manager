<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::with(['user', 'project'])->get();

        if (request()->ajax() || request()->wantsJson()) {
            return $tasks;
        }

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        return view('tasks.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $data = $request->validated();

        // Get the last task priority as the maximum priority
        $maxPriority = Task::where('project_id', $data['project_id'])->max('priority');

        $project = Project::find($data['project_id']);

        //  Launch a database transaction
        DB::transaction(function() use ($data, $maxPriority){
            Task::create([
                'name' => $data['name'],
                'user_id' => Auth::user()->id,
                'project_id' => $data['project_id'],
                'due_date' => $data['due_date'],
                'priority' => $maxPriority + 1
            ]);
        });

        //  Redirect to the previous page and flash a message
        return redirect()->route('projects.show', ['project' => $project]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        // get project
        $project = Project::find($task->project_id);

        $task->update([
            'name' => $request['name'],
            'date' => \Carbon\Carbon::parse($request['due_date'])->toDateTimeString()
        ]);

        return redirect()->route('projects.show', ['project' => $project]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //  Delete the course
        $task->delete();

        //  Redirect to the previous page and flash a message
        return back();
    }

    /**
     * Update Task Priority
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function updatePriority(Request $request)
    {
        $task = Task::find($request->id);

        $task->priority = $request->priority;

        $task->save();

        return $task;
    }
}
