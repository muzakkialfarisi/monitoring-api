@include('_layout._content.header')

@include('dashboard.chart')

@push('scripts')
    <script type="text/javascript">
        $(function () {
            $('.table').DataTable({
                order: [[4, 'desc']],
            });
            setTimeout(function () {
                var cek = 1;
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
                            // data: [10, 50, 12, 14, 10, 50, 12, 14, 10, 50, 12, 14],
                            barPercentage: .75,
                            categoryPercentage: .5
                        }, {
                            label: "body validation error",
                            backgroundColor: window.theme.dark,
                            borderColor: window.theme.dark,
                            hoverBackgroundColor: window.theme.dark,
                            hoverBorderColor: window.theme.dark,
                            // data: [10, 50, cek, 14, 10, 50, 12, 14, 10, 50, 12, 14],
                            barPercentage: .75,
                            categoryPercentage: .5
                        }, {
                            label: "time accumulation error",
                            backgroundColor: window.theme.warning,
                            borderColor: window.theme.warning,
                            hoverBackgroundColor: window.theme.warning,
                            hoverBorderColor: window.theme.warning,
                            // data: [10, 50, 12, 14, 10, 50, 12, 14, 10, 50, 12, 14],
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