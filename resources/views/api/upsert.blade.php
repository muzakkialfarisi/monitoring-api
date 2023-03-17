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
                    <input name="main_dealer_id" value="{{ $data->id ?? '' }}" hidden />

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
                        <input name="base_url" class="form-control" value="{{ $data->api->back_end->base_url ?? "https://" }}" readonly required/>
                    </div>
                    <div class="form-group required mb-3">
                        <label class="control-label">Path</label>
                        <input name="path" class="form-control" required value="{{ $data->api->path ?? "" }}"/>
                    </div>
                    <div class="form-group required mb-3">
                        <label class="control-label">Headers</label>                
                        <textarea class="form-control" name="headers_temp" rows="4" required>{{ $data->api->headers ?? "" }}</textarea>
                    </div>
                    <div class="form-group required mb-3">
                        <label class="control-label">Headers Value</label>                
                        <textarea class="form-control" name="headers" rows="4" readonly required>{{ $data->api->headers ?? "" }}</textarea>
                    </div>
                    <div class="form-group required mb-3">
                        <label class="control-label">Body</label>                
                        <textarea class="form-control" name="body" rows="4">{{ $data->api->body ?? "" }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 ps-3">
                            <h5 class="card-title"><strong>Validation</strong></h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group required mb-3">
                        <label class="control-label">Status Code Actual</label>
                        <input name="status_code_actual" class="form-control" value="{{ $data->api->status_code_actual ?? "" }}"/>
                    </div>
                    <div class="form-group required mb-3">
                        <label class="control-label">Response Time Actual</label>
                        <input name="response_time_actual" class="form-control" value="{{ $data->api->response_time_actual ?? "" }}"/>
                    </div>
                    <div class="form-group required mb-3">
                        <label class="control-label">Response Time Tolerance</label>
                        <input name="response_time_tolerance" class="form-control" value="{{ $data->api->response_time_tolerance ?? "" }}"/>
                    </div>
                    <div class="form-group required mb-3">
                        <label class="control-label">Response Body Actual</label>                
                        <textarea class="form-control" name="response_body_actual" rows="4">{{ $data->api->response_time_actual ?? "" }}</textarea>
                    </div>
                    <div class="form-group required mb-3">
                        <label class="control-label">Priority</label>
                        <select name="priority" class="form-control" required="required">
                            <option value="">Select...</option>
                            <option value="1">Critical</option>
                            <option value="2">High</option>
                            <option value="3">Medium</option>
                            <option value="4">Low</option>
                        </select>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="is_check_status_code" {{ isset($data->api->is_check_status_code) ? 'checked' : '' }} value="{{ isset($data->api->is_check_status_code) ? '1' : '0' }}">
                        <label class="form-check-label">Check Status Code</label>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="is_check_response_time" {{ isset($data->api->is_check_response_time) ? 'checked' : '' }} value="{{ isset($data->api->is_check_response_time) ? '1' : '0' }}">
                        <label class="form-check-label">Check Response Time</label>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="is_check_response_body" {{ isset($data->api->is_check_response_body) ? 'checked' : '' }} value="{{ isset($data->api->is_check_response_body) ? '1' : '0' }}">
                        <label class="form-check-label">Check Response Body</label>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="is_push_email" {{ isset($data->api->is_push_email) ? 'checked' : '' }} value="{{ isset($data->api->is_push_email) ? $data->api->is_push_email : 0 }}">
                        <label class="form-check-label">Push Email</label>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="is_active" {{ isset($data->api->is_active) ? 'checked' : '' }} value="{{ isset($data->api->is_active) ? $data->api->is_active : 0 }}">
                        <label class="form-check-label">Active</label>
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

        $('select[name="method"]').val("{{ $data->api->method ?? '' }}").change();
        $('select[name="feature_id"]').val("{{ $data->api->feature_id ?? '' }}").change();
        $('select[name="back_end_id"]').val("{{ $data->api->back_end_id ?? '' }}").change();
        $('select[name="priority"]').val("{{ $data->api->priority ?? '' }}").change();

        $('select[name="back_end_id"]').change(function(){
            $('input[name="base_url"]').val($(this).children('option:selected').data('base_url')).change();
        });

        $("input[name='path'], textarea[name='body']").on({
            keydown: function(e) {
                if (e.which === 32)
                return false;
            },
            change: function() {
                this.value = this.value.replace(/\s/g, "");
            }
        });

        $("textarea[name='headers_temp']").on({
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

        $("input[name='is_push_email']").click(function() {
            val = 0;
            if($(this).is(':checked')){
                val = 1;
            }
            $("input[name='is_push_email']").val(val);
        });
        $("input[name='is_check_status_code']").click(function() {
            val = 0;
            if($(this).is(':checked')){
                val = 1;
            }
            $("input[name='is_check_status_code']").val(val);
        });
        $("input[name='is_check_response_body']").click(function() {
            val = 0;
            if($(this).is(':checked')){
                val = 1;
            }
            $("input[name='is_check_response_body']").val(val);
        });
        $("input[name='is_check_response_time']").click(function() {
            val = 0;
            if($(this).is(':checked')){
                val = 1;
            }
            $("input[name='is_check_response_time']").val(val);
        });
        $("input[name='is_active']").click(function() {
            val = 0;
            if($(this).is(':checked')){
                val = 1;
            }
            $("input[name='is_active']").val(val);
        });
    </script>
@endpush

@include('_layout._content.footer')