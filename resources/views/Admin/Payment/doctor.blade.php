
<x-admin-master>
    @section('content')

    <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            {{-- <h6 class="card-title">Grand Total: {{$amount*$amount2}}</h6> --}}
                        </div>
                    </div>




{{--

             <div class="container-fluid">
                <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#exampleModalScrollable">Search with Date
                </button><br><br> --}}
                        <div class="row">
                           <div class="col-sm-12 col-lg-6 col-md-6">
                              <div class="card">
                                 <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">

                                      <h6>Service</h6>
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
                                                                  {{-- <th>Price</th> --}}
                                                            </tr>
                                                        </thead>
                                                        <tbody class="-body">
                                                                @foreach ($service_item as $items)
                                                                <tr>


                                                                <td>{{ $items->service }}</td>
                                                                <td>{{ $items->Amount }}</td>
                                                                {{-- <td>{{ $items->price *$service_items->qty}}</td> --}}
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
                                 </div>

                                    <div class="input-group mb-6">
                                    <div class="col-lg-12">
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




                         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                               <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                     <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                     </div>
                                                     <div class="modal-body">
                                                        ...
                                                     </div>
                                                     <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                     </div>
                                                  </div>
                                               </div>
                                            </div>
                                         </div>

                                        </div>
                                    </div>
                                 </div>

                                 {{-- @foreach ($emp2 as $emp2) --}}


                                 <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
                                           <h5 class="modal-title" style="margin-left: 150px" id="exampleModalScrollableTitle"> </h5>
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                             </button>
                                          </div>
                                   <div class="col-lg-12">
                                    <form action="" enctype="multipart/form-data" method="post">
                                           @csrf
                                          <div class="form-row">
                                             <div class="col-md-6">
                                            <label for="validationDefault02">Pick a date</label>
                                               <input type="date" class="form-control" name="from" id="date">
                                             </div>
                                      </div>
                                          <br><br>
                                         <center> <button type="submit" class="btn btn-primary">Search</button></center>
                                       </form>
                                       <br>
                                   </div>
                                </div>
                               </div>
                            </div>





    @endsection
</x-admin-master>
