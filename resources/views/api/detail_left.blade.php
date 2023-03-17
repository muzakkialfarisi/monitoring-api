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
                    Main Dealer
                </td>
                <td>
                    {{$data['api']['main_dealer']['name'] ?? ""}}
                </td>
            </tr>
            <tr>
                <td>
                    Feature
                </td>
                <td>
                    {{$data['api']['feature']['name'] ?? ""}}
                </td>
            </tr>
            <tr>
                <td>
                    URL
                </td>
                <td>
                    {{$data['api']['back_end']['base_url'] . $data['api']['path'] ?? ""}}
                </td>
            </tr>
            <tr>
                <td>
                    Request Headers
                </td>
                <td>
                    {{$data['api']['headers'] ?? ""}}
                </td>
            </tr>
            <tr>
                <td>
                    Request Body
                </td>
                <td>
                    {{$data['api']['body'] ?? ""}}
                </td>
            </tr>
        </table>

    </div>
</div>