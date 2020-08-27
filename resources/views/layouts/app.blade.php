<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>{{ trans('message.title') }}</title>
        <!-- Styles -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Fonts -->
        <link href="{{ asset('css/fontawesome.min.css') }}" rel='stylesheet' type='text/css'>
    </head>
    <body id="app-layout">
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ route('tasks.index') }}">
                        {{ trans('message.tasks_list') }}
                    </a>
                    <a class="navbar-brand">
                        |
                    </a>
                    <a class="navbar-brand" href="{{ route('employees.index') }}">
                        {{ trans('message.employees_list') }}
                    </a>
                    <a class="navbar-brand">
                        |
                    </a>
                    <a class="navbar-brand" href="{!! route('change-language', ['en']) !!}">
                        English
                    </a>
                    <a class="navbar-brand" href="{!! route('change-language', ['vi']) !!}">
                        Vietnam
                    </a>
                </div>
            </div>
        </nav>
        @yield('content')

        <!-- JavaScripts -->
        <script src="{{ asset('js/jquery-2.1.4.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    </body>
</html>
