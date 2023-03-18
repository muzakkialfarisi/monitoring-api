
<div class="modal fade" id="modal_upsert" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">

            <form asp-action="Upsert" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Feature</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input name="id" class="form-control" hidden/>
                    <div class="form-group required mb-3">
                        <label class="control-label">Name</label>
                        <input name="name" class="form-control" required />
                    </div>
                    <div class="form-group required mb-3">
                        <label class="control-label">Status</label>
                        <select name="is_active" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Non Active</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    <input type="submit" value="Save" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>