<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'asc')->get();

        return view('tasks', [
            'tasks' => $tasks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $validator = $request->validated();

        $input = $request->all();
        $task = Task::create($input);

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Task::findOrFail($id)->delete();

            return redirect()->route('tasks.index');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('tasks.index')->withErrors(trans('message.t_doesnt_exist'));
        }
    }

    public function removeEmployee($tId, $eId)
    {
        try {
            $task = Task::findOrFail($tId);
            $task->employees()->detach($eId);

            return redirect()->route('tasks.index');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('tasks.index')->withErrors(trans('message.t_doesnt_exist'));
        }
    }

    public function addEmployee(Request $request, $tId)
    {
        try {
            $task = Task::findOrFail($tId);
            $employee = Employee::find($request->input('employeeId'));
            if ($employee !== null) {
                $hasEmployee = $task->employees()->where('employee_id', $request->input('employeeId'))->exists();
                if (!$hasEmployee) {
                    $task->employees()->attach($request->input('employeeId'));

                    return redirect()->route('tasks.index');           
                } else {
                    return redirect()->route('tasks.index')->withErrors(trans('message.e_exists'));
                }
            } else {
                return redirect()->route('tasks.index')->withErrors(trans('message.e_doesnt_exist'));
            }
        } catch (ModelNotFoundException $e) {
            return redirect()->route('tasks.index')->withErrors(trans('message.t_doesnt_exist'));
        }

    }
}
