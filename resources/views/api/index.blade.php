@include('_layout._content.header')

<div class="card" style="min-height:700px">
    <div class="card-header border-bottom">
        <div class="d-flex align-items-center">
            <div class="flex-grow-1 ps-3">
                <h5 class="card-title"><strong>API {{ $data['name'] ?? "To Be Announced" }}</strong></h5>
            </div>
            <div class="row">
                <div class="col">
                    <a class="btn btn-primary">Add New API</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-striped">
                <thead>
                    <tr class="text-center">
                        <th>
                            action
                        </th>
                        <th>
                            id
                        </th>
                        <th>
                            back end
                        </th>
                        <th>
                            feature
                        </th>
                        <th>
                            url
                        </th>
                        <th>
                            is_header
                        </th>
                        <th>
                            is_body
                        </th>
                        <th>
                            status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data->api->rows as $item)
                        <tr>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-outline-tertiary" data-bs-toggle="dropdown"><i class="fas fa-fw fa-ellipsis-h"></i></button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item text-warning">Edit</a>
                                        <li><hr class="dropdown-divider"></li>
                                        <a class="dropdown-item text-danger">Delete</a>
                                    </li>
                                </ul>
                            </td>
                            <td>
                                {{$item['id']}}
                            </td>
                            <td>
                                {{$item['back_end']['name']}}
                            </td>
                            <td>
                                {{$item['feature']['name']}}
                            </td>
                            <td>
                                {{$item['back_end']['base_url'].$item['path']}}
                            </td>
                            <td class="text-center">
                                @if (count($item['headers'])> 0) 
                                    <i class='fas fa-check-circle'></i>
                                @endif
                            </td>
                            <td class="text-center">
                                @if (count($item['body'])> 0) 
                                    <i class='fas fa-check-circle'></i>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($item['is_active'] == true)
                                    <span class="badge bg-success"> active </span>
                                @else
                                    <span class="badge bg-warning"> nonactive </span>
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