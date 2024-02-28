<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $myTasks = Tasks::where('Owner_id', Auth::id())->limit(3)->get();
        $assignedTasks = Tasks::where('User_id', Auth::id())->get();
        $task_count = Tasks::count();
        $users = User::select('id','name')->get();

        
        return Inertia::render('Dashboard', [
            'tasks' => $myTasks,
            'assignedTasks' => $assignedTasks,
            'task_count' => $task_count,
            'users' => $users
        ]);
        
    }

    public function getTasks()
    {
        $users = User::select('id','name')->get();
        $tasks = Tasks::select('id','title','description','user_id','status')->get();
        
        return Inertia::render('Tasks/Index')
            ->with('users', $users)
            ->with('tasks', $tasks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $task = Tasks::create([
            'title' => $request->title,
            'description' => $request->description,
            'User_id' => $request->User_id,
            'status' => 'pending',
            'Owner_id' => Auth::id()
        ]);

        if($task){
            return response()->json([
                'Status' => 'Success', 
                'message' => 'Task created successfully']);
        }else{
            return response()->json([
                'Status' => 'Failed',
                'message' => 'Task creation failed']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tasks $tasks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tasks $tasks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tasks $task)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);
        
        if($task->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'marks' => $request->marks
        ])){
            return response()->json([
                'Status' => 'Success', 
                'message' => 'Campaign updated successfully']);
        }else{
            return response()->json([
                'Status' => 'Failed',
                'message' => 'Campaign update failed']);
        }
        return redirect()->back();
    }

    public function updateProgress(Request $request, Tasks $task)
    {
        $task->update([
            'status' => $request->status
        ]);

        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tasks $task)
    {
        //Log::info($task);
        
        if($task->delete()){
            return response()->json([
                'Status' => 'Success', 
                'message' => 'task deleted successfully']);
        }else{
            return response()->json([
                'Status' => 'Failed',
                'message' => 'task deletion failed']);
        }

        return redirect()->back();
    }
}
