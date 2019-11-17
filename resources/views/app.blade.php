<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.Laravel = { csrfToken: '{{  csrf_token() }}' }</script>
        <title>Event 25 Years Lab Manager</title>
        <link rel="stylesheet" href="{{ url('assets/vendors/core/core.css') }}">
        <link rel="stylesheet" href="{{ url('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ url('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
        <link rel="stylesheet" href="{{ url('assets/vendors/simplemde/simplemde.min.css') }}">
        <link rel="stylesheet" href="{{ url('assets/vendors/dropzone/dropzone.min.css') }}">
        <link rel="stylesheet" href="{{ url('assets/vendors/dropify/dist/dropify.min.css') }}">
        <link rel="stylesheet" href="{{ url('assets/css/demo_1/style.css') }}">
        <link rel="shortcut icon" href="{{ url('assets/images/favicon.png') }}"/>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>

            <div id="app">
                <router-view></router-view>
            </div>
            
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ url('assets/vendors/core/core.js') }}"></script>
        <script src="{{ url('assets/vendors/chartjs/Chart.min.js') }}"></script>
        <script src="{{ url('assets/vendors/jquery.flot/jquery.flot.js') }}"></script>
        <script src="{{ url('assets/vendors/jquery.flot/jquery.flot.resize.js') }}"></script>
        <script src="{{ url('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ url('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ url('assets/vendors/simplemde/simplemde.min.js') }}"></script>
        <script src="{{ url('assets/vendors/dropzone/dropzone.min.js') }}"></script>
        <script src="{{ url('assets/vendors/dropify/dist/dropify.min.js') }}"></script>
        <script src="{{ url('assets/js/simplemde.js') }}"></script>
        <script src="{{ url('assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
        <script src="{{ url('assets/vendors/feather-icons/feather.min.js') }}"></script>
        <script src="{{ url('assets/js/dashboard.js') }}"></script>
        <script src="{{ url('assets/js/datepicker.js') }}"></script>
    </body>
</html>
