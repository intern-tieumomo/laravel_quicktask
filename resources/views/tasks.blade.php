@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>{{ trans('message.new_task') }}</strong>
                </div>
                <div class="panel-body">
                    @include('common.errors')

                    <form action="{{ route('tasks.store') }}" method="POST" class="form-horizontal">
                        @csrf

                        <div class="form-group">
                            <label for="task" class="col-sm-3 control-label">{{ trans('message.task') }}</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="task-name" class="form-control" placeholder="{{ trans('message.name') }}">
                            </div>
                        </div>

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

            @if (count($tasks) > config('number.no_task'))
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>{{ trans('message.current_tasks') }}</strong>
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">

                            <thead>
                                <th>{{ trans('message.task') }}</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </thead>

                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td class="table-text">
                                            <div>{{ $task->name }}</div>
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#employeeModal{{ $task->id }}">
                                                {{ trans('message.view_employees') }}
                                            </button>

                                            <div class="modal fade" id="employeeModal{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                <strong>{{ trans('message.employee') }}</strong> {{ trans('message.for_task') }} #{{ $task->id }}
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
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
                                                                            <th scope="col">&nbsp;</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($task->employees as $employee)
                                                                            <tr>
                                                                                <td>{{ $employee->name }}</td>
                                                                                <td>{{ $employee->birthday }}</td>
                                                                                <td>{{ $employee->phone }}</td>
                                                                                <td>{{ $employee->email }}</td>
                                                                                <td>
                                                                                    <form action="{{ route('tasks.remove-employee', [$task->id, $employee->id]) }}" method="POST">
                                                                                        @csrf
                                                                                        @method('DELETE')

                                                                                        <input type="hidden" name="id" value="{{ $task->id }}">
                                                                                        <button type="submit" class="btn btn-danger">
                                                                                            <i class="fa fa-trash"></i> {{ trans('message.delete') }}
                                                                                        </button>
                                                                                    </form>
                                                                                </td>
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

                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-e{{ $task->id }}">{{ trans('message.add_employee') }}</button>

                                            <div class="modal fade" id="add-e{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"><strong>{{ trans('message.employee') }}</strong> {{ trans('message.for_task') }} #{{ $task->id }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('tasks.add-employee', $task->id) }}" method="POST" class="form-horizontal">
                                                                @csrf

                                                                <div class="form-group">
                                                                    <label for="e" class="col-sm-3 control-label">ID</label>

                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="employeeId" id="e-id" class="form-control" placeholder="ID">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <div class="col-sm-offset-3 col-sm-6">
                                                                        <button type="submit" class="btn btn-default">
                                                                            <i class="fa fa-plus"></i> {{ trans('messgae.add_employee') }}
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

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
