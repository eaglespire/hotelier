<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>

    <meta charset="utf-8" />
    <title>{{ $title }} | {{ config('app.name') }} - {{ $titleDesc }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{ $description }}" name="description" />
    <meta content="Eaglespire" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('dashboard/images/favicon.ico') }}">

    <!-- jsvectormap css -->
    <link href="{{ asset('dashboard/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

    <!--Swiper slider css-->
    <link href="{{ asset('dashboard/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
    @yield('css')
    <!-- Layout config Js -->
    <script src="{{ asset('dashboard/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('dashboard/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('dashboard/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('dashboard/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('dashboard/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    @stack('styles')
    @livewireStyles
</head>
