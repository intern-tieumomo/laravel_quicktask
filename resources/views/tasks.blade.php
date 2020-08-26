@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>{{ trans('message.new_task') }}</strong>
                </div>
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Task Form -->
                    <form action="{{ route('tasks.store') }}" method="POST" class="form-horizontal">
                        @csrf

                        <!-- Task Name -->
                        <div class="form-group">
                            <label for="task" class="col-sm-3 control-label">{{ trans('message.task') }}</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="task-name" class="form-control" placeholder="Task Name">
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-plus"></i> {{ trans('message.add_task') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Tasks -->
            @if (count($tasks) > config('number.no_task'))
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>{{ trans('message.current_tasks') }}</strong>
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">

                            <!-- Table Headings -->
                            <thead>
                                <th>{{ trans('message.task') }}</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </thead>

                            <!-- Table Body -->
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <!-- Task Name -->
                                        <td class="table-text">
                                            <div>{{ $task->name }}</div>
                                        </td>

                                        <!-- Button trigger modal -->
                                        <td>
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#employeeModal{{ $task->id }}">
                                            {{ trans('message.view_employees') }}
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="employeeModal{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"><strong>{{ trans('message.employee') }}</strong> {{ trans('message.for_task') }} #{{ $task->id }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body" style="overflow-x: auto">
                                                            @if (count($task->employees) < config('number.min_employees'))
                                                                {{ trans('message.no_employee') }}
                                                            @else
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">{{ trans('message.name') }}</th>
                                                                            <th scope="col">{{ trans('message.birthday') }}</th>
                                                                            <th scope="col">{{ trans('message.phone') }}</th>
                                                                            <th scope="col">{{ trans('message.email') }}</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($task->employees as $employee)
                                                                            <tr>
                                                                                <td>{{ $employee->name }}</td>
                                                                                <td>{{ $employee->birthday }}</td>
                                                                                <td>{{ $employee->phone }}</td>
                                                                                <td>{{ $employee->email }}</td>
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
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-trash"></i> {{ trans('message.delete') }}
                                                </button>
                                            </form  >
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
