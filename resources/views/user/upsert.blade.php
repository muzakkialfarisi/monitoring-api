@include('_layout._content.header')

<form method="post" action="{{ route('user.upsert_process') }}">
    @csrf
    <div class="row">
        <div class="col-12 col-sm-6">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 ps-3">
                            <h5 class="card-title"><strong>User</strong></h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <input name="id" class="form-control" hidden/>
                    <div class="form-group required mb-3">
                        <label class="control-label">Name</label>
                        <input name="name" class="form-control" required />
                    </div>
                    <div class="form-group required mb-3">
                        <label class="control-label">Username</label>
                        <input name="username" class="form-control" required />
                    </div>
                    <div class="form-group required mb-3">
                        <label class="control-label">Email</label>
                        <input name="email" type="email" class="form-control" required />
                    </div>
                    <div class="form-group required mb-3">
                        <label class="control-label">Status</label>
                        <select name="is_active" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Non Active</option>
                        </select>
                    </div>
                </div>
            </div>   
            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="submit">Save</button>
                <a asp-action="Index" class="btn btn-dark" href="{{ route('user.index') }}">Back</a>
            </div>   
        </div>
    </div>
</form>


@push('scripts')
    <script type="text/javascript">
        $("input[name='username']").keyup(function(){
            this.value = this.value.toLowerCase();
        });
    </script>
@endpush

@include('_layout._content.footer')