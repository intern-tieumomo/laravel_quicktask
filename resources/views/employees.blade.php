@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>{{ trans('message.new_employee') }}</strong>
                </div>
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Employee Form -->
                    <form action="{{ route('employees.store') }}" method="POST" class="form-horizontal">
                        @csrf

                        <!-- Employee Name -->
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">{{ trans('message.name') }}</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="employee-name" class="form-control" placeholder="{{ trans('message.name') }}">
                            </div>
                        </div>

                        <!-- Employee Birthday -->
                        <div class="form-group">
                            <label for="birthday" class="col-sm-3 control-label">{{ trans('message.birthday') }}</label>

                            <div class="col-sm-6">
                                <input type="date" name="birthday" id="employee-birthday" class="form-control" placeholder="{{ trans('message.birthday') }}">
                            </div>
                        </div>

                        <!-- Employee Phone -->
                        <div class="form-group">
                            <label for="phone" class="col-sm-3 control-label">{{ trans('message.phone') }}</label>

                            <div class="col-sm-6">
                                <input type="text" name="phone" id="employee-phone" class="form-control" placeholder="{{ trans('message.phone') }}">
                            </div>
                        </div>

                        <!-- Employee Email -->
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">{{ trans('message.email') }}</label>

                            <div class="col-sm-6">
                                <input type="email" name="email" id="employee-email" class="form-control" placeholder="{{ trans('message.email') }}">
                            </div>
                        </div>

                        <!-- Add Employee Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-plus"></i> {{ trans('message.add_employee') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Tasks -->
            @if (count($employees) > config('number.no_employees'))
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>{{ trans('message.current_employees') }}</strong>
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">

                            <!-- Table Headings -->
                            <thead>
                                <th>{{ trans('message.employee') }}</th>
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
                                            {{ trans('message.view_tasks') }}
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="employeeModal{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"><strong>{{ trans('message.task') }}</strong> {{ trans('message.for_employee') }}: {{ $employee->name }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body" style="overflow-x: auto">
                                                            @if (count($employee->tasks) < config('number.min_tasks'))
                                                                {{ trans('message.no_task') }}
                                                            @else
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">{{ trans('message.name') }}</th>
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
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('message.close') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Delete Button -->
                                        <td>
                                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-trash"></i> {{ trans('message.delete') }}
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
