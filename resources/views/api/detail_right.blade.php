@if (isset($data['api']['status_code_log']))
    <div class="card">
        <div class="card-header border-bottom">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1 ps-3">
                    <h5 class="card-title"><strong>Status Code</strong></h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <td>
                        Factual
                    </td>
                    <td>
                        {{$data['api']['status_code_log']['status_code_factual']}}
                    </td>
                </tr>
                <tr>
                    <td>
                        Actual
                    </td>
                    <td class="text-danger">
                        {{$data['api']['status_code_log']['status_code_actual']}}
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endif

@if (isset($data['api']['response_time_log']))
    <div class="card">
        <div class="card-header border-bottom">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1 ps-3">
                    <h5 class="card-title"><strong>Response Time</strong></h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <td>
                        Factual
                    </td>
                    <td>
                        {{$data['api']['response_time_log']['response_time']}}
                    </td>
                </tr>
                <tr>
                    <td>
                        Actual
                    </td>
                    <td class="text-danger">
                        {{$data['api']['response_time_log']['response_time_accumulation']}}
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endif

@if (isset($data['api']['response_body_log']))
    <div class="card">
        <div class="card-header border-bottom">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1 ps-3">
                    <h5 class="card-title"><strong>Response Body</strong></h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <td>
                        Factual
                    </td>
                    <td>
                        {{$data['api']['response_body_log']['response_body_factual']}}
                    </td>
                </tr>
                <tr>
                    <td>
                        Actual
                    </td>
                    <td class="text-danger">
                        {{$data['api']['response_body_log']['response_body_actual']}}
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endif
