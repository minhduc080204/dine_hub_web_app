<!DOCTYPE html>
<html lang="en">
@include('admin.layouts.components.head')

<body>

    @include('admin.layouts.components.header')
    @include('admin.layouts.components.sidebar')
    <main id="main" class="main">
        @include('admin.layouts.components.pageTitle')
        @yield('content')
    </main>

    @include('admin.layouts.components.footer')
    @include('admin.layouts.components.php')
    @include('admin.layouts.components.scripts')
    @yield('scripts')
    <div class="position-fixed top-0 end-0 p-3 mt-5" style="z-index: 110" id="toastcontainer"></div>
</body>

</html>
