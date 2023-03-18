<!DOCTYPE html>
<html lang="en">
    @include('fixed.head')
    <body>
        @include('fixed.nav')

        @include('fixed.header')
        
        @yield('content')

        @include('fixed.footer')
        @include('fixed.scripts')
    </body>
</html>
