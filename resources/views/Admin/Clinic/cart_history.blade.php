<x-admin-master>
    @section('content')

        <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h6 style="color: seagreen" class="card-title">Special Vaccine History  </h6>
                        </div>



                        <div class="header-title">
                          <a href="{{route('Admin.Payment.Payment_list')}}"> <button class="btn btn-primary">Back</button></a>
                         </div>

                        {{-- <center> <h4  style="color: red" class="card-title">{{gmdate(" jS \ F Y ")}} </h4></center> --}}
                     </div>
                     <div class="card-body">
                        <div class="table-responsive">
                           <table id="datatable" class="table data-table table-striped">
                              <thead>
                                 <tr class="ligth">
                                    <th>Name</th>
                                    <th>vaccine</th>
                                    <th>qty</th>
                                    <th>Phone No</th>
                                    <th>Order Status</th>
                                    <th>Date</th>
                                    <th>Date</th>
                                    <th>Assigned</th>

                                 </tr>
                              </thead>
                              <tbody>
                                @foreach ($cart_history as $cart_history)
                                <tr>
                                 <td>{{$cart_history->vaccineiteams[0]->vaccine_id}} </td>
                                 <td>{{$cart_history->vaccineiteams[0]->qty}} </td>
                                <td>{{$cart_history->user_id}}</td>
                                <td>{{$cart_history->phone}}</td>
                                <td><button type="button" class="btn btn-danger btn-sm mr-2">{{$cart_history->order_status}}</button></td>
                                <td>{{$cart_history->address}}</td>
                                <td>{{$cart_history->date}}</td>
                                <td>{{$cart_history->order_status}}</td>

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

    @endsection
</x-admin-master>
