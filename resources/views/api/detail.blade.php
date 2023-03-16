@include('_layout._content.header')

<div class="row">
    <div class="col">
        @include('api.detail_left')
    </div>
    <div class="col">
        @include('api.detail_right')
        <div class="d-grid gap-2">
            <a asp-action="Index" class="btn btn-dark" href="{{ route('api.alert') }}">Back</a>
        </div>  
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        $(function(){
            $('.table').DataTable({
            });
        });
    </script>
@endpush

@include('_layout._content.footer')