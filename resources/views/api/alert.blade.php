@include('_layout._content.header')

<div class="card" style="min-height:700px">
    <div class="card-header border-bottom">
        <div class="d-flex align-items-center">
            <div class="flex-grow-1 ps-3">
                <h5 class="card-title"><strong>API</strong></h5>
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
                            main dealer
                        </th>
                        <th>
                            url
                        </th>
                        <th>
                            status code
                        </th>
                        <th>
                            response time
                        </th>
                        <th>
                            response body
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['api']->rows as $item)
                        <tr>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-outline-tertiary" data-bs-toggle="dropdown"><i class="fas fa-fw fa-ellipsis-h"></i></button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item text-warning" href="{{ route('api.detail', ['main_dealer_id' => $item['main_dealer']['id'], 'id' => $item['id']]) }}">Detail</a>
                                        <li><hr class="dropdown-divider"></li>
                                        <a class="dropdown-item text-danger">Delete</a>
                                    </li>
                                </ul>
                            </td>
                            <td>
                                {{$item['main_dealer']['name']}} | 
                                {{$item['back_end']['name']}} | 
                                {{$item['feature']['name']}}
                            </td>
                            <td>
                                {{$item['back_end']['base_url']}}
                            </td>
                            <td class="text-center">
                                @if ($item['status_code_validation'] == true) 
                                    <i class='fas fa-check-circle'></i>
                                @else 
                                    <i class='fas fa-times-circle text-danger'></i>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($item['response_time_validation'] == true) 
                                    <i class='fas fa-check-circle'></i>
                                @else 
                                    <i class='fas fa-times-circle text-danger'></i>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($item['response_body_validation'] == true) 
                                    <i class='fas fa-check-circle'></i>
                                @else 
                                    <i class='fas fa-times-circle text-danger'></i>
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