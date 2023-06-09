@include('_layout._content.header')

<div class="card" style="min-height:700px">
    <div class="card-header border-bottom">
        <div class="d-flex align-items-center">
            <div class="flex-grow-1 ps-3">
                <h5 class="card-title"><strong>User</strong></h5>
            </div>
            <div>
                <a class="btn btn-primary btn-pill btn-upsert" href="{{ route('user.upsert') }}">Add New User</a>
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
                            name
                        </th>
                        <th>
                            email
                        </th>
                        <th>
                            created date
                        </th>
                        <th>
                            status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                        <tr>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-outline-tertiary" data-bs-toggle="dropdown"><i class="fas fa-fw fa-ellipsis-h"></i></button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('user.upsert', ['id' => $item['id']]) }}">Edit</a>
                                    </li>
                                </ul>
                            </td>
                            <td>
                                {{$item['name']}}
                            </td>
                            <td class="text-center">
                                {{$item['email']}}
                            </td>
                            <td class="text-center">
                                {{$item['created_at']}}
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