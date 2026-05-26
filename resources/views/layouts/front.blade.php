<!DOCTYPE html>
<html lang="en">


@include('common.front.fronthead')

<body>

    @include('common.front.frontheader')

    @yield('content')

    @include('common.front.frontfooter')

    @include('common.front.frontfooterjs')

    @yield('scripts')


</body>



</html>
