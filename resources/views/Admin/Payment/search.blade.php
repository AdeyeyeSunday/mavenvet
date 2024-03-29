<x-admin-master>
    @section('content')
        <div class="container-fluid add-form-list">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h5 class="card-title" style="color: red">Grand Total: {{ number_format($grandTotal, 2) }}</h5>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-12 col-lg-6 col-md-6">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between">
                                            <div class="header-title">
                                                <h6>Service</h6>
                                            </div>
                                            <div class="header-title">
                                                <h6>Total: {{ number_format($amt, 2) }}</h6>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="input-group mb-4">
                                                <div class="card card-block card-stretch card-height blog pricing-details">
                                                    <div class="card-body text-center rounded">
                                                        <div class="table-responsive rounded mb-3">
                                                            <table class="data-table table mb-0 tbl-server-info">
                                                                <thead class="bg-white">
                                                                    <tr class=" -data">
                                                                        <th>Service</th>
                                                                        <th>Amount</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="-body">
                                                                    @foreach ($service_item as $items)
                                                                        <tr>
                                                                            <td>{{ $items->service }}</td>
                                                                            <td>{{ $items->Amount }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-6 col-md-6">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between">
                                            <div class="header-title">
                                                <h6 class="card-title">All Vaccine Treatment</h6>
                                            </div>

                                            <div class="header-title">
                                                <h6>Total: {{ number_format($amount2, 2)   }}</h6>
                                            </div>
                                        </div>


                                        <div class="input-group mb-6">
                                            <div class="col-lg-12">
                                                <br>
                                                <div class="table-responsive rounded mb-3">
                                                    <table class="data-table table mb-0 tbl-server-info">
                                                        <thead class="bg-white">
                                                            <tr class=" -data">
                                                                <th>Vaccine</th>
                                                                <th>Qty</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="-body">
                                                            @foreach ($service_items as $service_items)
                                                                <tr>
                                                                    <td>{{ $service_items->prod_name }}</td>
                                                                    <td>{{ $service_items->total_quantity }}</td>
                                                                    <td>{{ $service_items->price * $service_items->total_quantity }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endsection
</x-admin-master>
