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
        //$myTasks = Tasks::where('Owner_id', Auth::id())->limit(3)->get();
        $myTasks = Tasks::where('Owner_id', Auth::id())
        ->select(
            'tasks.id',
            'tasks.title',
            'tasks.description',
            'tasks.User_id',
            'tasks.Owner_id',
            'tasks.status',
            'tasks.marks',
            'owner.name as owner_name',
            'user.name as assigned_user_name'
        )
        ->join('users as owner', 'owner.id', '=', 'tasks.Owner_id')
        ->leftJoin('users as user', 'user.id', '=', 'tasks.User_id')
        ->limit(3)
        ->get();

        $assignedTasks = Tasks::where('User_id', Auth::id())
        ->select(
            'tasks.id',
            'tasks.title',
            'tasks.description',
            'tasks.User_id',
            'tasks.Owner_id',
            'tasks.status',
            'tasks.marks',
            'owner.name as owner_name',
            'user.name as assigned_user_name'
        )
        ->join('users as owner', 'owner.id', '=', 'tasks.Owner_id')
        ->leftJoin('users as user', 'user.id', '=', 'tasks.User_id')
        ->limit(3)
        ->get();

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
        $tasks = Tasks::select(
            'tasks.id',
            'tasks.title',
            'tasks.description',
            'tasks.User_id',
            'tasks.Owner_id',
            'tasks.marks',
            'tasks.status',
            'owner.name as owner_name',
            'user.name as assigned_user_name'
        )
        ->join('users as owner', 'owner.id', '=', 'tasks.Owner_id')
        ->leftJoin('users as user', 'user.id', '=', 'tasks.User_id')
        ->get();
        
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
            'marks' => $request->marks,
            'User_id' => $request->userId,
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
