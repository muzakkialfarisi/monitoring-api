@include('_layout._content.header')

<form method="post" action="{{ route('api.upsert.process', $data->id, $data->api->id ?? null) }}">
    @csrf
    <div class="row">
        <div class="col-12 col-sm-6">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 ps-3">
                            <h5 class="card-title"><strong>Api</strong></h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <input name="id" value="{{ $data['api']->id ?? '' }}" hidden />

                    <div class="form-group required mb-3">
                        <label class="control-label">Feature</label>
                        <select name="feature_id" class="form-control" required="required">
                            <option value="">Select...</option>
                            @foreach ($data['feature']->rows as $item)
                                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group required mb-3">
                        <label class="control-label">Method</label>
                        <select name="method" class="form-control" required="required">
                            <option value="">Select...</option>
                            <option value="GET">GET</option>
                            <option value="POST">POST</option>
                            <option value="DELETE">DELETE</option>
                            <option value="PUT">PUT</option>
                        </select>
                    </div>

                    <div class="form-group required mb-3">
                        <label class="control-label">Back End</label>
                        <select name="back_end_id" class="form-control" required="required">
                            <option value="">Select...</option>
                            @foreach ($data['back_end']->rows as $item)
                                <option value="{{ $item['id'] }}" data-base_url="{{ $item['base_url'] }}">{{ $item['name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group required mb-3">
                        <label class="control-label">Base URL</label>
                        <input name="base_url" class="form-control" value="{{ $data->back_end->rows['id'][$data->api] ?? "https://" }}" readonly required/>
                    </div>
                    <div class="form-group required mb-3">
                        <label class="control-label">Path</label>
                        <input name="path" class="form-control" required value="{{ $data->api->path ?? "" }}"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 ps-3">
                            <h5 class="card-title"><strong>Json</strong></h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group required mb-3">
                        <label class="control-label">Headers</label>                
                        <textarea class="form-control" name="headers_temp" rows="4" required>{{ $data->api->headers->value ?? "" }}</textarea>
                    </div>
                    <div class="form-group required mb-3">
                        <label class="control-label">Headers Value</label>                
                        <textarea class="form-control" name="headers" rows="4" readonly required>{{ $data->api->headers->value ?? "" }}</textarea>
                    </div>
                    <div class="form-group required mb-3">
                        <label class="control-label">Body</label>                
                        <textarea class="form-control" name="body" rows="4" required>{{ $data->api->body->value ?? "" }}</textarea>
                    </div>
                </div>
            </div>   
            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="submit">Save</button>
                <a asp-action="Index" class="btn btn-dark" href="{{ route('api.index', $data->id) }}">Back</a>
            </div>   
        </div>
    </div>
</form>


@push('scripts')
    <script type="text/javascript">
        $(function(){
            $('.table').DataTable({
            });
        });

        $('select[name="back_end_id"]').change(function(){
            $('input[name="base_url"]').val($(this).children('option:selected').data('base_url')).change();
        });

        $("input[name='path'], textarea[name='headers_temp'], textarea[name='body']").on({
            keydown: function(e) {
                if (e.which === 32)
                return false;
            },
            change: function() {
                this.value = this.value.replace(/\s/g, "");

                headers = this.value;
                $("textarea[name='headers']").html(headers.replace(/Bearer/g, "Bearer "))
            }
        });
    </script>
@endpush

@include('_layout._content.footer')