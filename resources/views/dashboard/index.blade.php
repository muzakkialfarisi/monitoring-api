@include('_layout._content.header')

{{-- <div class="card" style="min-height:700px">
    <div class="card-header border-bottom">
        <div class="d-flex align-items-center">
            <div class="flex-grow-1 ps-3">
                <h5 class="card-title"><strong>Log</strong></h5>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr class="text-center">
                        <th>
                            Action
                        </th>
                        <th>
                            Main Dealer
                        </th>
                        <th>
                            Feature
                        </th>
                        <th>
                            URL
                        </th>
                        <th>
                            Status Code
                        </th>
                        <th>
                            Response Body 
                        </th>
                        <th>
                            Response Time
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data->rows as $item)
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-tertiary" data-bs-toggle="dropdown"><i class="fas fa-fw fa-ellipsis-h"></i></button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" asp-action="Detail" asp-route-DONumber="@item.DONumber" asp-route-TenantId="@item.TenantId">Details</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" asp-controller="Print" asp-action="DeliveryOrderManifest" asp-route-DONumber="@item.DONumber" target="_blank">Print Manifes Delivery Order</a>
                                    </li>
                                </ul>
                            </td>
                            <td>
                                {{$item['main_dealer_name']}}
                            </td>
                            <td>
                                {{$item['feature_name']}}
                            </td>
                            <td>
                                {{$item['url']}}
                            </td>
                            <td class="text-center">
                                @if($item['status_code_validation'] == true)
                                    <span class="badge bg-success"> true </span>
                                @else
                                    <span class="badge bg-danger"> false </span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($item['response_body_validation'] == true)
                                    <span class="badge bg-success"> true </span>
                                @else
                                    <span class="badge bg-danger"> false </span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($item['response_time_validation'] == true)
                                    <span class="badge bg-success"> true </span>
                                @else
                                    <span class="badge bg-danger"> false </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div> --}}

@include('dashboard.chart')

@push('scripts')
    <script type="text/javascript">
        $(function () {
            $('.table').DataTable({
                order: [[4, 'desc']],
            });
            setTimeout(function () {
                new Chart(document.getElementById("chartjs-dashboard-bar-alt"), {
                    type: "bar",
                    data: {
                        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                        datasets: [{
                            label: "status validation error",
                            backgroundColor: window.theme.danger,
                            borderColor: window.theme.danger,
                            hoverBackgroundColor: window.theme.danger,
                            hoverBorderColor: window.theme.danger,
                            data: [10, 50, 12, 14, 10, 50, 12, 14, 10, 50, 12, 14],
                            barPercentage: .75,
                            categoryPercentage: .5
                        }, {
                            label: "body validation error",
                            backgroundColor: window.theme.dark,
                            borderColor: window.theme.dark,
                            hoverBackgroundColor: window.theme.dark,
                            hoverBorderColor: window.theme.dark,
                            data: [10, 50, 12, 14, 10, 50, 12, 14, 10, 50, 12, 14],
                            barPercentage: .75,
                            categoryPercentage: .5
                        }, {
                            label: "time accumulation error",
                            backgroundColor: window.theme.warning,
                            borderColor: window.theme.warning,
                            hoverBackgroundColor: window.theme.warning,
                            hoverBorderColor: window.theme.warning,
                            data: [10, 50, 12, 14, 10, 50, 12, 14, 10, 50, 12, 14],
                            barPercentage: .75,
                            categoryPercentage: .5
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                gridLines: {
                                    display: false
                                },
                                stacked: false,
                                ticks: {
                                    stepSize: 20
                                }
                            }],
                            xAxes: [{
                                stacked: false,
                                gridLines: {
                                    color: "transparent"
                                }
                            }]
                        }
                    }
                });
            }, 1000);
        });
    </script>
@endpush

@include('_layout._content.footer')