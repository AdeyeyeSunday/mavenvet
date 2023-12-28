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
                            <a href="{{route('Admin.Payment.due_payment')}}"><button class="btn btn-primary">Due Payment List</button></a>
                             </div>

                        <div class="header-title">
                        <a href="{{route('Admin.Payment.Account_cash')}}"><button class="btn btn-primary">Back</button></a>
                         </div>



                        {{-- <center> <h4  style="color: red" class="card-title">Outstanding Payment: ₦ {{$Outstanding_Payment}}</h4></center> --}}
                     </div>
                     <div class="card-body">

                        <div class="table-responsive">
                           <table id="datatable" class="table data-table table-striped">
                              <thead>
                                 <tr class="ligth">
                                    <tr class="ligth">
                                        <th>Pet Name</th>
                                       <th>Owner Name</th>
                                        <th>Phone No</th>
                                        <th>Total bill</th>
                                        <th>Amount Paid</th>
                                        <th>Outstanding</th>

                                        <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>




                                @foreach ($pay as $payment)
                                @if ($payment->due > 0)
                                <td>{{$payment->Pet_name}} {{$payment->Unregister}}</td>
                                <td>{{$payment->Owner_name}}</td>
                                <td>{{$payment->Phone}}</td>
                                <td>{{$payment->total_price}}</td>
                                <td>{{$payment->pay}}</td>
                                <td> {{$payment->due}}</td>
                                {{-- <td>{{$payment->Veterinarian}}</td> --}}

                                <td>
                                    <div class="d-flex align-items-center list-action">

                                        <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="update payment"
                                            href="{{route('Admin.Payment.Payment_edit',$payment->id)}}"><i class="ri-pencil-line mr-0"></i></a>
                                    </div>
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
