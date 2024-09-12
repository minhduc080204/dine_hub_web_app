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
    @include('admin.layouts.components.scripts')

</body>

</html>
