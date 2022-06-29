<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.layouts.partials._head')
    @include('frontend.layouts.partials._css')

</head>

<body style="background-color: #ddefff; margin: 0;padding: 0;">
    @include('frontend.layouts.partials._nav')

    {{-- @include('frontend.layouts.partials._contnt') --}}
    @yield('content')

    @include('frontend.layouts.partials._footer')


    @include('frontend.layouts.partials._script')
</body>

</html>
