<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title>@yield('browser-title', config('app.name')) | {{ config('app.name') }}</title>

    <!-- Fonts -->
    @section('fonts')
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    @show

    <!-- Stylesheets -->
    @section('header-stylesheets')
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/coreui-static/css/style.min.css') }}" rel="stylesheet">

        <link rel="stylesheet" href="{{asset('admin/coreui-static/css/jquery.dataTables.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin/coreui-static/css/datatable1.10.18.css')}}">
        <link href="{{ asset('admin/coreui-static/vendors/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/coreui-static/css/select2.min.css') }}" rel="stylesheet">
    @show

    <!-- Custom Styles -->
    <style type="text/css">
        @yield('custom-styles')
    </style>

    <!-- Header Vars -->
    <script type="text/javascript">@yield('header-js')</script>

    {{-- Scripts --}}
    @yield('header-scripts')
    <script src="{{ asset('admin/coreui-static/js/jquery3.3.0.js') }}"></script>
    <script src="{{ asset('admin/coreui-static/js/datatable1.10.18-min.js') }}"></script>
    <script src="{{ asset('admin/coreui-static/js/select2.min.js') }}"></script>
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden footer-fixed">
