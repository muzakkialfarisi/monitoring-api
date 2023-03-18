
@if (Session::has('success'))
    <script type="text/javascript">
        toastr.success("{{Session::get('success')}}",'', {
            positionClass: 'toast-top-right',
            closeButton: false,
            progressBar: false,
            newestOnTop: true,
            rtl: $("body").attr("dir") === "rtl" || $("html").attr("dir") === "rtl",
            timeOut: 3000
        });
    </script>
@endif

@if (Session::has('error'))
    <script type="text/javascript">
        toastr.error("{{Session::get('error')}}",'', {
            positionClass: 'toast-top-right',
            closeButton: false,
            progressBar: false,
            newestOnTop: true,
            rtl: $("body").attr("dir") === "rtl" || $("html").attr("dir") === "rtl",
            timeOut: 3000
        });
    </script>
@endif