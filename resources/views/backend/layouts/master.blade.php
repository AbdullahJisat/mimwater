<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('backend.layouts.partials._head')
    @include('backend.layouts.partials._css')
</head>

<body>
    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            @include('backend.layouts.partials._nav')
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    @include('backend.layouts.partials._sidenav')
                    @include('backend.layouts.partials._content')
                    <div id="styleSelector">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.layouts.partials._script')
</body>

</html>
