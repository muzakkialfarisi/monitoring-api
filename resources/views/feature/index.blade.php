@include('_layout._content.header')

<div class="card" style="min-height:700px">
    <div class="card-header border-bottom">
        <div class="d-flex align-items-center">
            <div class="flex-grow-1 ps-3">
                <h5 class="card-title"><strong>Feature</strong></h5>
            </div>
            <div>
                <button class="btn btn-primary btn-pill btn-upsert" data-bs-toggle="modal" data-bs-target="#modal_upsert">Add New Feature</button>
                @include('feature.upsert')
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
                            name
                        </th>
                        <th>
                            status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data->rows as $item)
                        <tr>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-outline-tertiary" data-bs-toggle="dropdown"><i class="fas fa-fw fa-ellipsis-h"></i></button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item text-warning btn-upsert" 
                                        data-id="{{ $item['id'] }}"
                                        data-name="{{ $item['name'] }}"
                                        data-is_active="{{ $item['is_active'] }}"
                                        data-bs-toggle="modal" data-bs-target="#modal_upsert">Edit</a>
                                    </li>
                                </ul>
                            </td>
                            <td>
                                {{$item['id']}}
                            </td>
                            <td>
                                {{$item['name']}}
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

        $('.btn-upsert').on('click', function () {
            if(typeof $(this).data("id") === 'undefined'){
                $("input[name='id']").val("");
                $("input[name='name']").val("");
                $("select[name='is_active']").val(1).change();
            }
            else{
                $("input[name='id']").val($(this).data("id"));
                $("input[name='name']").val($(this).data("name"));
                $("select[name='is_active']").val($(this).data("is_active")).change();
            }
        });
    </script>
@endpush

@include('_layout._content.footer')