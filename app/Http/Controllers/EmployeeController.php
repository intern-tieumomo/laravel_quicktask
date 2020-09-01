<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|max:255',
            'birthday' => 'required',
            'phone'    => 'required|max:10',
            'email'    => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/employees')
                ->withInput()
                ->withErrors($validator);
        }

        $employee = new Employee;
        $employee->name = $request->input('name');
        $employee->birthday = $request->input('birthday');
        $employee->phone = $request->input('phone');
        $employee->email = $request->input('email');
        $employee->save();

        return redirect('/employees');
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

        return redirect('/employees');
    }

    public function removeTask($eId, $tId)
    {
        $employee = Employee::find($eId);
        $employee->tasks()->detach($tId);

        return redirect('/employees');
    }

    public function addTask(Request $request, $eId)
    {
        $employee = Employee::find($eId);
        $task = Task::find($request->input('t-id'));
        if ($task !== null) {
            $hasT = $employee->tasks()->where('task_id', $request->input('t-id'))->exists();
            if (!$hasT) {
                $employee->tasks()->attach($request->input('t-id'));

                return redirect('/employees');           
            } else {
                return redirect('/employees')->withErrors(trans('message.t_exists'));
            }
        } else {
            return redirect('/employees')->withErrors(trans('message.t_doesnt_exist'));
        }

    }
}
