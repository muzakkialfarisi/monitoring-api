
        <script src="{{ URL::asset('lib/js/app.js') }}"></script>
        <script src="{{ URL::asset('lib/sweetalert2/sweetalert2.min.js') }}"></script>
        @stack('scripts')
        @include('_layout.html_notification')
    </body>
</html>