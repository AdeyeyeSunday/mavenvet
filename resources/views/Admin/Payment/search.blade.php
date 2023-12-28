
<x-admin-master>
    @section('content')
    <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                             <h4 class="card-title" style="color: red">Grand Total: {{$amount2+$amt}}</h4>
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
                                        <h6>Total: {{$amt}}</h6>
                                      </div>
                                 </div>
                                 <div class="card-body">
                                    <div class="input-group mb-4">

                                        <div class="card card-block card-stretch card-height blog pricing-details">
                                            <div class="card-body text-center rounded">

                                                <div class="table-responsive rounded mb-3">
                                                    <table class="data-table table mb-0 tbl-server-info">
                                                        <thead class="bg-white text-uppercase">
                                                            <tr class="ligth ligth-data">
                                                                <th>Service</th>
                                                                  <th>Amount</th>
                                                                  {{-- <th>Price</th> --}}
                                                            </tr>
                                                        </thead>
                                                        <tbody class="ligth-body">
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

                                        <h6>Total: {{$amount2}}</h6>
                                      </div>
                                 </div>


                                    <div class="input-group mb-6">
                                    <div class="col-lg-12">
                                        <div class="table-responsive rounded mb-3">
                                        <table class="data-table table mb-0 tbl-server-info">
                                            <thead class="bg-white text-uppercase">
                                                <tr class="ligth ligth-data">
                                                    <th>Vaccine</th>
                                                    <th>Qty</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody class="ligth-body">
                                                @foreach ($service_items as $service_items)
                                                <tr>
                                                <td>{{ $service_items->prod_name }}</td>
                                                <td>{{ $service_items->total_quantity }}</td>
                                                <td>{{ $service_items->price *$service_items->total_quantity}}</td>
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
