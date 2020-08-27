<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>{{ trans('message.title') }}</title>
        <!-- Styles -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <!-- Fonts -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </body>
</html>
