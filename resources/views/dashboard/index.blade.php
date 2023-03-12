@include('_layout._content.header')

<div class="card" style="min-height:700px">
    <div class="card-header border-bottom">
        <div class="d-flex align-items-center">
            <div class="flex-grow-1 ps-3">
                <h5 class="card-title"><strong>All Main Dealer</strong></h5>
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
                            DO Number
                        </th>
                        <th>
                            PO Number
                        </th>
                        <th>
                            Tenant
                        </th>
                        <th>
                            Warehouse
                        </th>
                        <th>
                            Supplier
                        </th>
                        <th>
                            Product
                        </th>
                        <th>
                            Qty
                        </th>
                        <th>
                            Date
                        </th>
                        <th>
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach (var item in Model)
                    {
                        <tr>
                            <td>
                                <button type="button" class="btn btn-outline-tertiary" data-bs-toggle="dropdown"><i class="fas fa-fw fa-ellipsis-h"></i></button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" asp-action="Upsert" asp-route-DONumber="@item.DONumber" asp-route-TenantId="@item.TenantId">Manage</a></li>
                                    <li>
                                        <a class="dropdown-item" asp-controller="Print" asp-action="DeliveryOrderManifest" asp-route-DONumber="@item.DONumber" target="_blank">Print Manifes Delivery Order</a>
                                    </li>
                                </ul>
                            </td>
                            <td class="text-center">
                                @Html.DisplayFor(modelItem => item.DOSupplier)
                            </td>
                            <td class="text-center">
                                @Html.DisplayFor(modelItem => item.PONumber)
                            </td>
                            <td>
                                @Html.DisplayFor(modelItem => item.MasDataTenant.Name)
                            </td>
                            <td>
                                @Html.DisplayFor(modelItem => item.MasHouseCode.HouseName)
                            </td>
                            <td>
                                @if (item.MasSupplierData != null)
                                {
                                    @Html.DisplayFor(modelItem => item.MasSupplierData.Name)
                                }
                            </td>
                            <td class="text-center">
                                @Html.DisplayFor(modelItem => item.IncDeliveryOrderProducts.Count)
                            </td>
                            <td class="text-center">
                                @item.IncDeliveryOrderProducts.Sum(m => m.Quantity)
                            </td>
                            <td>
                                @String.Format("{0:dd/MM/yyyy}", item.DateDelivered)
                            </td>
                            <td class="text-center">
                                @if (item.Status == "Open")
                                {
                                    <span>@item.Status</span>
                                }
                                @if (item.Status == "DO")
                                {
                                    <span class="badge bg-secondary">@item.Status</span>
                                }
                                @if (item.Status == "AR")
                                {
                                    <span class="badge bg-info">@item.Status</span>
                                }
                                @if (item.Status == "PUT")
                                {
                                    <span class="badge bg-primary">@item.Status</span>
                                }
                            </td>
                        </tr>
                    } --}}
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