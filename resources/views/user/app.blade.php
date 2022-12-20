<!DOCTYPE html>
<html lang="en">

<!-- Head -->

    @include('user.layouts.head')

<body>

    <!-- Navigation -->

        @include('user.layouts.navigation')

    <!-- Main content -->

        @yield('main-content')

    <!-- Footer -->

        @include('user.layouts.footer')


    <!-- Core theme JS -->
    <script src="{{asset('user/js/scripts.js')}}"></script>

    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
