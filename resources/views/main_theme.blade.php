<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>JT Pack of foods (E-commerce)</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">

    @include('layout.css')

    @yield('css')

    <style>
        .line-clamp{
            -webkit-line-clamp: 2;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            white-space: normal;
            overflow: hidden;
        }
    </style>
</head>
<body>

    <div class="main-wrapper">
        @include('layout.header')

        @yield('content')

        @include('layout.footer')
    </div>

    @include('layout.script')

    @yield('script')

</body>

</html>