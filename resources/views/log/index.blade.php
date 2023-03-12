@include('_layout._content.header')

<div class="card" style="min-height:700px">
    <div class="card-header border-bottom">
        <div class="d-flex align-items-center">
            <div class="flex-grow-1 ps-3">
                <h5 class="card-title"><strong>Log {{ $main_dealer }}</strong></h5>
            </div>
            <div class="row">
                <div class="col">
                    <div class="input-group">
                        <button class="btn btn-outline-primary" data-bs-toggle="dropdown">Export</button>
                        <div class="dropdown-menu">
                            <button class="dropdown-item btn-export" data-id="Excel" target="_blank">Excel</button>
                        </div>
                    </div>
                </div>
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
                                        <a class="dropdown-item">Detail</a>
                                        <a class="dropdown-item">TBA</a>
                                    </li>
                                </ul>
                            </td>
                            <td>
                                {{$item['feature_name']}}
                            </td>
                            <td>
                                {{$item['url']}}
                            </td>
                            <td class="text-center">
                                @if($item['status_code_validation'] == true)
                                    <span class="badge bg-success"> success </span>
                                @else
                                    <span class="badge bg-danger"> failed </span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($item['response_body_validation'] == true)
                                    <span class="badge bg-success"> success </span>
                                @else
                                    <span class="badge bg-danger"> failed </span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($item['response_time_validation'] == true)
                                    <span class="badge bg-success"> success </span>
                                @else
                                    <span class="badge bg-danger"> failed </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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