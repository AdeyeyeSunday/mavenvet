<x-admin-master>
    @section('content')

        <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h6 style="color: red" class="card-title">Total Outstanding Payment: ₦ {{$amount}}</h6>
                        </div>





                        <div class="header-title">
                        <a href="{{route('Admin.Payment.Payment_list')}}"><button class="btn btn-primary">New Paid</button></a>
                         </div>



                        {{-- <center> <h4  style="color: red" class="card-title">New Paid : </h4></center> --}}
                     </div>
                     <div class="card-body">

                        <div class="table-responsive">
                           <table id="datatable" class="table data-table table-striped">
                              <thead>
                                 <tr class="">
                                    <tr class="">
                                        <th>Pet Name</th>
                                       <th>Owner Name</th>
                                        <th>Phone No</th>
                                        <th>Total bill</th>
                                        <th>Amount Paid</th>
                                        <th>Outstanding</th>
                                        {{-- <th>Veterinarian</th> --}}
                                        {{-- <th>Action</th> --}}
                                 </tr>
                              </thead>
                              <tbody>




                                @foreach ($pay as $payment)
                                @if ($payment->due > 0)
                                <td>{{$payment->Pet_name}}{{ $payment->Unregister }}</td>
                                <td>{{$payment->Owner_name}}</td>
                                <td>{{$payment->Phone}}</td>
                                <td>{{$payment->total_price}}</td>
                                <td>{{$payment->pay}}</td>
                                <td> {{$payment->due}}</td>
                                {{-- <td>{{$payment->Veterinarian}}</td> --}}

                                <td>

                                </td>
                                 </tr>
                                 @endif
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
