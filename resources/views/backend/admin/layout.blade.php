<!DOCTYPE html>

<html lang="en">

<head>
    @include('backend.admin.dashboard.components.head')
</head>

<body>
    <div class="main-wrapper">

        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar">
            @include('backend.admin.dashboard.components.sidebar')
        </nav>

        <!-- partial -->

        <div class="page-wrapper">

            <!-- partial:partials/_navbar.html -->
            @include('backend.admin.dashboard.components.toolbox')
            <!-- partial -->

            <div class="page-content">

                @yield('admin')


            </div>

            <!-- partial:partials/_footer.html -->
            @include('backend.admin.dashboard.components.footer')
            <!-- partial -->

        </div>
    </div>
    @include('backend.admin.dashboard.components.script')
</body>

</html>
