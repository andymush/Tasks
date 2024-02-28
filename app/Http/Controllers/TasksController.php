<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $users = User::select('id','name')->get();
        $tasks = Tasks::select('id','title','description','user_id')->get();
        
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
         Log::info($request->all());
        $request->validate([
            'title' => 'required',
        ]);

        $task = Tasks::create([
            'title' => $request->title,
            'description' => $request->description,
            'User_id' => $request->user_id,
            'status' => 'pending',
        ]);

        // return Inertia::render('Tasks/Index')
        //     ->with('success', 'Task created successfully');
        // return response()->json([
        //     'Status' => 'success',
        //     'Message' => 'Task created successfully']);

            // if($campaign->update($data)){
            //     return response()->json([
            //         'Status' => 'Success', 
            //         'message' => 'Campaign updated successfully']);
            // }else{
            //     return response()->json([
            //         'Status' => 'Failed',
            //         'message' => 'Campaign update failed']);
            // }

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
    public function update(Request $request, Tasks $tasks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tasks $tasks)
    {
        //
    }
}
