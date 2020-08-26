@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>New Employee</strong>
                </div>
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Employee Form -->
                    <form action="{{ url('employees') }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Employee Name -->
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Name</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="employee-name" class="form-control" placeholder="Employee Name">
                            </div>
                        </div>

                        <!-- Employee Birthday -->
                        <div class="form-group">
                            <label for="birthday" class="col-sm-3 control-label">Birthday</label>

                            <div class="col-sm-6">
                                <input type="date" name="birthday" id="employee-birthday" class="form-control" placeholder="Employee Birthday">
                            </div>
                        </div>

                        <!-- Employee Phone -->
                        <div class="form-group">
                            <label for="phone" class="col-sm-3 control-label">Phone</label>

                            <div class="col-sm-6">
                                <input type="text" name="phone" id="employee-phone" class="form-control" placeholder="Employee Phone">
                            </div>
                        </div>

                        <!-- Employee Email -->
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Email</label>

                            <div class="col-sm-6">
                                <input type="email" name="email" id="employee-email" class="form-control" placeholder="Employee Email">
                            </div>
                        </div>

                        <!-- Add Employee Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-plus"></i> Add Employee
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Tasks -->
            @if (count($employees) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Current Employees</strong>
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">

                            <!-- Table Headings -->
                            <thead>
                                <th>Employee</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </thead>

                            <!-- Table Body -->
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <!-- Employee Name -->
                                        <td class="table-text">
                                            <div>{{ $employee->name }}</div>
                                        </td>

                                        <!-- Button trigger modal -->
                                        <td>
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#employeeModal{{ $employee->id }}">
                                            View Tasks
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="employeeModal{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"><strong>Task</strong> for Employee: {{ $employee->name }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body" style="overflow-x: auto">
                                                            @if (count($employee->tasks) < 1)
                                                                No task.
                                                            @else
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">Name</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($employee->tasks as $task)
                                                                            <tr>
                                                                                <td>{{ $task->name }}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Delete Button -->
                                        <td>
                                            <form action="{{ url('employees/'.$employee->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection