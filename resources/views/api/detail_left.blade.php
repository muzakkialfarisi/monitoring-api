<div class="card">
    <div class="card-header border-bottom">
        <div class="d-flex align-items-center">
            <div class="flex-grow-1 ps-3">
                <h5 class="card-title"><strong>Detail</strong></h5>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table">
            <tr>
                <td>
                    Created At
                </td>
                <td>
                    {{$data['api']['response_body_log']['created_at']}}
                </td>
            </tr>
            <tr>
                <td>
                    Main Dealer
                </td>
                <td>
                    {{$data['api']['main_dealer']['name']}}
                </td>
            </tr>
            <tr>
                <td>
                    Feature
                </td>
                <td>
                    {{$data['api']['feature']['name']}}
                </td>
            </tr>
            <tr>
                <td>
                    URL
                </td>
                <td>
                    {{$data['api']['response_body_log']['url']}}
                </td>
            </tr>
            <tr>
                <td>
                    Request Headers
                </td>
                <td>
                    {{$data['api']['response_body_log']['request_header']}}
                </td>
            </tr>
            <tr>
                <td>
                    Request Payload
                </td>
                <td>
                    {{$data['api']['response_body_log']['request_payload']}}
                </td>
            </tr>
        </table>

    </div>
</div>