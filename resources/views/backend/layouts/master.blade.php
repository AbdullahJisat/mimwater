<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @includeIf('backend.layouts.partials._head')
    @includeIf('backend.layouts.partials._css')
</head>

<body>
    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            @includeIf('backend.layouts.partials._nav')
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    @includeIf('backend.layouts.partials._sidenav')
                    @includeIf('backend.layouts.partials._content')
                    <div id="styleSelector">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @includeIf('backend.layouts.partials._script')
    @stack('script')
</body>

</html>
