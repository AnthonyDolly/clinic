<!DOCTYPE html>
<html lang="en">
<head>
    @include('theme.frontoffice.layouts.includes.head')
    @yield('head')
</head>
<body>
    @include('theme.frontoffice.layouts.includes.nav')
    <main>
        @yield('content')
    </main>
    @include('theme.frontoffice.layouts.includes.footer')
    @include('theme.frontoffice.layouts.includes.foot')
    @yield('foot')
</body>
</html>