@include('_layout._content.header')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header border-bottom">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 ps-3">
                        <h5 class="card-title"><strong>Api</strong></h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <input name="id" hidden />

                <div class="form-group required mb-3">
                    <label class="control-label">Back End</label>
                    <select name="Flag" class="form-control">
                        <option>Select...</option>
                        @foreach ($data['backend']->rows as $item)
                            <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger field-validation-valid" data-valmsg-for="JobPosCode" data-valmsg-replace="true"></span>
                </div>

                <div class="form-group required mb-3">
                    <label class="control-label">Feature</label>
                    <select name="Flag" class="form-control">
                        <option>Select...</option>
                        @foreach ($data['feature']->rows as $item)
                            <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger field-validation-valid" data-valmsg-for="JobPosCode" data-valmsg-replace="true"></span>
                </div>

                <div class="form-group required mb-3">
                    <label class="control-label">Path</label>
                    <input name="JobPosCode" class="form-control" required />
                    <span class="text-danger field-validation-valid" data-valmsg-for="JobPosCode" data-valmsg-replace="true"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-header border-bottom">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 ps-3">
                        <h5 class="card-title"><strong>Detail</strong></h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group required mb-3">
                    <label class="control-label">Path</label>
                    <div class="input-group required mb-3">
                        <span class="input-group-text" id="basic-addon2">authorization</span>
                        <input type="text" class="form-control" placeholder="Bearer t0k3nn" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    </div>
                </div>
                <div class="form-group required mb-3">
                    <label class="control-label">Body</label>                
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            </div>
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