<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title')</title>
    @yield('css-link')
    @include('components.header')
</head>

<body>

    @include('components.nav')


    <!-- section 2  -->

    @yield('content')


    <!-- section-7  -->
    @include('components.footer')


    @yield('page-script')
    

</body>

</html>