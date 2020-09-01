<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::orderBy('created_at', 'asc')->get();

        return view('employees', [
            'employees' => $employees,
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
    public function store(EmployeeRequest $request)
    {
        $validator = $request->validated();

        $input = $request->all();
        $employee = Employee::create($input);

        return redirect()->route('employees.index');
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
        Employee::find($id)->delete();

        return redirect()->route('employees.index');
    }

    public function removeTask($eId, $tId)
    {
        $employee = Employee::find($eId);
        $employee->tasks()->detach($tId);

        return redirect()->route('employees.index');
    }

    public function addTask(Request $request, $eId)
    {
        $employee = Employee::find($eId);
        $task = Task::find($request->input('taskId'));
        if ($task !== null) {
            $hasT = $employee->tasks()->where('task_id', $request->input('taskId'))->exists();
            if (!$hasT) {
                $employee->tasks()->attach($request->input('taskId'));

                return redirect()->route('employees.index');           
            } else {
                return redirect()->route('employees.index')->withErrors(trans('message.t_exists'));
            }
        } else {
            return redirect()->route('employees.index')->withErrors(trans('message.t_doesnt_exist'));
        }

    }
}
